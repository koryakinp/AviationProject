<?php

class DataBase {

    private static function connect() {
        try {
            $xml = simplexml_load_file(dirname(__FILE__) . '/config.xml') or die("Error: Cannot create object");
            $host = $xml->database->db . ':host=' . $xml->database->host . ';dbname=' . $xml->database->dbname;
            $username = $xml->database->username . '';
            $password = $xml->database->password . '';

            return new PDO($host, $username, $password);
        } catch (PDOException $ex) {
            echo $ex->getMessage();
        }
    }

        static function getTopicViewData($topicID, $curPage) {      
        $messageFrom = ($curPage - 1) * MESSAGES_PER_PAGE;       
        $query = self::connect()->prepare("
            SELECT
                Messages.messageID,
                Messages.messageBody,
                Messages.datePosted,
                Messages.dateUpdated,
                Messages.topicID,
                Messages.userID,
                Users.username,
                Users.role,
                UNIX_TIMESTAMP(Users.lastActiveDate) as lastActiveDate,
                CAST(Users.registrationDate AS DATE) as registrationDate,
                Total.totalUserMessages,
                Topics.title
            FROM Messages
                JOIN Users ON Users.userID = Messages.userID
                JOIN (
                    SELECT
                        COUNT(Messages.messageID) as totalUserMessages,
                        Users.userID
                    FROM Users
                    JOIN Messages ON Users.userID = Messages.userID
                    GROUP BY Users.userID)
                    Total ON Users.userID = Total.userID
                JOIN Topics ON Messages.topicID = Topics.topicID
            WHERE Messages.topicID = :topicID
            ORDER BY Messages.messageID ASC
            LIMIT :from, :max");
        $query->bindValue(':from', (int) $messageFrom, PDO::PARAM_INT);
        $query->bindValue(':max', (int) MESSAGES_PER_PAGE, PDO::PARAM_INT);
        $query->bindValue(':topicID', (int) $topicID, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    }

    static function getProfileViewData($userID) {
        $query = self::connect()->prepare("SELECT "
                . "Users.userID, "
                . "Users.username, "
                . "Users.registrationDate, "
                . "Users.role,"
                . "Users.status, "
                . "Users.lastActiveDate as lastActiveDate, "
                . "Users.sex,"
                . "Users.email, "
                . "Users.location, "
                . "Count(Messages.messageID) as messageCount "
                . "FROM Users "
                . "JOIN Messages ON Messages.userID = Users.userID "
                . "WHERE Users.userID = ?");
        $query->execute(array($userID));
        return $query->fetch();
    }

    static function getCategoryViewData($categoryID, $curPage) {
        $query = self::connect()->prepare(
                "SELECT 
                    t.topicID as topicID, 
                    u.username as authorUsername,
                    uu.username as lastPostUsername,
                    u.userID as authorUserID,
                    uu.userID as lastPostUserID,
                    t.title,
                    t.status,
                    COUNT(m.messageID) AS postsCount,
                    MAX(m.datePosted) AS lastPostedDate,
                    (SELECT COUNT(*) FROM Topics WHERE CategoryID = :categoryID) as topicCount
                    FROM
                    Messages m
                    JOIN Users u ON m.userID = u.userID
                    JOIN Topics t ON t.topicID = m.topicID
                    JOIN Users uu on t.userID = uu.userID
                    WHERE 
                    t.categoryID = :categoryID
                    AND
                    t.status <> 'deleted'
                    GROUP BY t.topicID
                    ORDER BY 
                    case t.status
                        when 'pinned' then 1
                        else 2
                    end,
                    lastPostedDate DESC   
                    LIMIT :from, :max"
        );

        $query->bindValue(':from', (int) ($curPage - 1) * TOPICS_PER_PAGE, PDO::PARAM_INT);
        $query->bindValue(':max', (int) TOPICS_PER_PAGE, PDO::PARAM_INT);
        $query->bindValue(':categoryID', (int) $categoryID, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll();
    }
    
    static function getForumViewData() {
        $query = self::connect()->prepare("
            SELECT
                Categories.categoryID,
                Categories.categoryName,
                Categories.rootCategoryID,
                Categories.categoryDescription, 
                c.lastPostUsername,
                c.lastPostUserID,
                c.lastPostDate,
                c.messages,
                t.topics
            FROM
                Categories
            LEFT JOIN(
                SELECT 
                    COUNT(*) as messages, 
                    MAX(Messages.datePosted) as lastPostDate, 
                    Users.username as lastPostUsername,
                    Users.userID as lastPostUserID,    
                    Categories.categoryID
                FROM 
                    Messages
                    JOIN Topics ON Topics.topicID = Messages.topicID
                    JOIN Categories ON Categories.categoryID = Topics.categoryID
                    JOIN Users ON Topics.userID = Users.userID
                    WHERE Topics.status <> 'deleted'
                    GROUP BY Categories.categoryID
                ) c ON Categories.categoryID = c.categoryID
            LEFT JOIN(
                SELECT 
                    COUNT(*) as topics, 
                    Categories.categoryID
                FROM 
                    Topics
                    JOIN Categories ON Categories.categoryID = Topics.categoryID
                    WHERE status <> 'deleted'
                    GROUP BY Categories.categoryID
                ) t ON Categories.categoryID = t.categoryID
                ");
        $query->execute();
        return $query->fetchAll();
    }

    static function updateLastActiveTime($userID) {
        $query = self::connect()->prepare("
            UPDATE
                Users
                SET
                    lastActiveDate = " . time() . "
                WHERE
                    Users.userID = ?
            ");
        $query->execute(array($userID));
    }
    
    static function updatePassword($user) {
        $query = self::connect()->prepare("
            UPDATE
                Users
                SET
                    passwordHash = ?
                WHERE
                    Users.userID = ?
            ");
        $query->execute(array($user->getPasswordHash(), $user->getUserID()));
    }

    static function getForumStatistics() {
        $query = self::connect()->prepare("
            SELECT
                (SELECT COUNT(*)
                FROM   Users) AS countUsers,
                (SELECT COUNT(*)
                FROM   Messages) AS countMessages,
                (SELECT COUNT(*)
                FROM   Topics) AS countTopics
                FROM    dual
            ");
        $query->execute();
        return $query->fetch();
    }

    static function getPostsCount($topicID) {
        $query = self::connect()->prepare("SELECT COUNT(*) as postsCount FROM Messages WHERE topicID = ?");
        $query->execute(array($topicID));
        return $query->fetch();
    }

    static function getTopicsCount($categoryID) {
        $query = self::connect()->prepare("SELECT COUNT(*) as topicsCount FROM Topics WHERE categoryID = ? AND status <> 'deleted'");
        $query->execute(array($categoryID));
        return $query->fetch();
    }

    static function getCategoryNames() {
        $query = self::connect()->prepare("SELECT categoryName, categoryID FROM Categories");
        $query->execute();
        return $query->fetchAll();
    }

    static function getCategories() {
        $query = self::connect()->prepare("SELECT * FROM Categories");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, "Category"); 
    }
    
    static function getCategory($col, $val) {
        $query = self::connect()->prepare("SELECT * FROM Categories WHERE ".$col." = ?");
        $query->execute(array($val));
        return $query->fetchObject('Category');
    }
    
    static function updateCategory(Category $category) {
        $query = self::connect()->prepare("UPDATE "
                . "Categories "
                . "SET "
                . "categoryDescription = ?, categoryName = ?, rootCategoryID = ? "
                . "WHERE categoryID = ?");
        return $query->execute(array(
                    $category->getCategoryDescription(),
                    $category->getCategoryName(),
                    $category->getRootCategoryID(),
                    $category->getCategoryID()
        ));
    }

    static function getTopicFirstMessage($topicID) {
        $query = self::connect()->prepare("SELECT MIN(MessageID) as firstMessageID FROM Messages WHERE TopicID = ?");
        $query->execute(array($topicID));
        return $query->fetch();
    }

    static function deleteMessage($messageID) {
        $query = self::connect()->prepare("DELETE FROM Messages WHERE MessageID = ?");
        return $query->execute($messageID);
    }

    static function addMessage(Message $message) {
        try {
            $query = self::connect()->prepare("INSERT INTO "
                    . "Messages "
                    . "(topicID,messageBody,dateUpdated,userID) "
                    . "VALUES (?,?,NOW(),?)");
            $query->execute(array($message->getTopicID(), $message->getMessageBody(), $message->getUserID()));
        } catch (PDOException $ex) {
            
        }
    }

    static function updateMessage(Message $message) {
        $query = self::connect()->prepare("UPDATE "
                . "Messages "
                . "SET "
                . "messageBody = ?, dateUpdated = NOW() "
                . "WHERE messageID = ?");
        return $query->execute(array(
                    $message->getMessageBody(),
                    $message->getMessageID()
        ));
    }

    static function getMessage($messageID) {
        $query = self::connect()->prepare("SELECT * FROM Messages WHERE MessageID = ?");
        $query->execute(array($messageID));
        return $query->fetchObject('Message');
    }

    static function updateTopic(Topic $topic) {
        $query = self::connect()->prepare("UPDATE "
                . "Topics "
                . "SET "
                . "categoryID = ?, status = ?, title = ? "
                . "WHERE topicID = ?");
        return $query->execute(array(
                    $topic->getCategoryID(),
                    $topic->getStatus(),
                    $topic->getTitle(),
                    $topic->getTopicID()
        ));
    }

    static function addTopic(Topic $topic) {
        $con = self::connect();
        $query = $con->prepare("INSERT INTO "
                . "Topics "
                . "(title, categoryID, userID) "
                . "VALUES (?,?,?)");
        $query->execute(array($topic->getTitle(), $topic->getCategoryID(), $topic->getUserID()));
        $lastID = $con->lastInsertId();
        return $lastID;
    }

    static function getTopic($topicID) {
        $query = self::connect()->prepare("SELECT * FROM Topics WHERE TopicID = ?");
        $query->execute(array($topicID));
        return $query->fetchObject('Topic');
    }

    static function deleteCategory($categoryID) {
        $query = self::connect()->prepare("DELETE FROM Categories WHERE CategoryID = ?");
        return $query->execute(array($categoryID));
    }

    static function addCategory(Category $category) {
        $query = self::connect()->prepare("INSERT INTO Categories VALUES (NULL,?,?,?)");
        return $query->execute(array($category->getCategoryName(), $category->getCategoryDescription(), $category->getRootCategoryID()));
    }

    static function updateUser(User $user) {
        $query = self::connect()->prepare("UPDATE "
                . "Users "
                . "SET "
                . "role = ?, sex = ?, location = ?, status = ?, passwordHash = ?, activation = ?"
                . "WHERE UserID = ?");
        return $query->execute(array(
                    $user->getRole(),
                    $user->getSex(),
                    $user->getLocation(),
                    $user->getStatus(),
                    $user->getPasswordHash(),
                    $user->getActivation(),
                    $user->getUserID()
                    
        ));
    }

    static function addUser(User $user) {
        $con = self::connect();
        $query = $con->prepare("INSERT INTO "
                . "Users "
                . "(username, passwordHash, email, activation, salt, lastActiveDate, registrationDate) "
                . "VALUES (?,?,?,?,?,?,?)");
        $query->execute(array(
            $user->getUsername(),
            $user->getPasswordHash(),
            $user->getEmail(),
            $user->getActivation(),
            $user->getSalt(),
            $user->getLastActiveDate(),
            $user->getRegistrationDate()
        ));

        return $con->lastInsertId();
    }
    
    static function getRule($ruleID) {
        $query = self::connect()->prepare("SELECT * FROM rules WHERE ruleID = ?");
        $query->execute(Array($ruleID));
        return $query->fetchObject('Rule');
    } 

    static function addRule(Rule $rule) {
        $con = self::connect();
        $query = $con->prepare("INSERT INTO "
                . "rules "
                . "(ruleTopic, ruleContent, categoryID) "
                . "VALUES (?,?,?)");
        $query->execute(array($rule->getRuleTopic(), $rule->getRuleContent(), $rule->getCategoryID()));
        $lastID = $con->lastInsertId();
        return $lastID;
    }
    static function updateRule(Rule $rule) {
        $query = self::connect()->prepare("UPDATE "
                . "rules "
                . "SET "
                . "ruleTopic = ?, ruleContent = ?, categoryID = ? "
                . "WHERE ruleID = ?");
        return $query->execute(array(
                    $rule->getRuleTopic(),
                    $rule->getRuleContent(),
                    $rule->getCategoryID(),
                    $rule->getRuleID()
        ));
    }
    static function updateRuleCategory(RuleCategory $ruleCategory) {
        $query = self::connect()->prepare("UPDATE "
                . "ruleCategory "
                . "SET "
                . "categoryName = ?"
                . "WHERE categoryID = ?");
        return $query->execute(array(
                    $ruleCategory->getCategoryName(),
                    $ruleCategory->getCategoryID()
        ));
    }
    static function deleteRule($ruleID) {
        $query = self::connect()->prepare("DELETE FROM rules WHERE ruleID = ?");
        return $query->execute(Array($ruleID));
    }

    static function getRuleCategoryNames() {
        $query = self::connect()->prepare("SELECT categoryName, categoryID FROM ruleCategory");
        $query->execute();
        return $query->fetchAll();
    }

    static function deleteRuleCategory($categoryID) {
        $query = self::connect()->prepare("DELETE FROM ruleCategory WHERE categoryID = ?");
        return $query->execute(array($categoryID));
    }

    static function getRuleCategory($categoryID) {
        $query = self::connect()->prepare("SELECT * FROM ruleCategory WHERE categoryID = ?");
        $query->execute(array($categoryID));
        return $query->fetchObject('RuleCategory');
    }

    static function getRules(){
        $query = self::connect()->prepare("SELECT * FROM rules ORDER BY ruleID");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, "Rule");       
    }   
    
    static function addRuleCategory(RuleCategory $rulecategory) {
        $query = self::connect()->prepare("INSERT INTO ruleCategory VALUES (NULL,?)");
        return $query->execute(array($rulecategory->getCategoryName()));
    }
    
    static function getRuleCategories() {
        $query = self::connect()->prepare("SELECT * FROM ruleCategory ORDER BY categoryID");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_CLASS, "RuleCategory");
    } 

    static function getRulesByCategory($categoryID) {
        $query = self::connect()->prepare("SELECT * FROM rules WHERE categoryID = ? ORDER BY ruleID");
        $query->execute(array($categoryID));
        return $query->fetchAll();
    }

    static function getUser($col, $val) {
        try {
            $query = self::connect()->prepare("SELECT * FROM Users WHERE " . $col . " = ?");
            $query->execute(array($val));
            $user = $query->fetchObject('User');
            return $user;
        } catch (PDOException $ex) {
            
        }
    }

    static function login($col, $val, $col2, $val2) {
        try {
            $query = self::connect()->prepare("SELECT * FROM Users WHERE " . $col . " = ? AND " . $col2 . " = ?");
            $query->execute(array($val, $val2));
            $user = $query->fetchObject('User');
            return $user;
        } catch (PDOException $ex) {
            
        }
    }

    static function getSalt($username) {
        $query = self::connect()->prepare("SELECT salt FROM Users WHERE username = ?");

        $query->execute(array($username));
        return $query->fetch();
    }

    static function addSession(Session $session) {
        $con = self::connect();
        $query = $con->prepare("INSERT INTO "
                . "users_session "
                . "(userID, hash) "
                . "VALUES (?,?)");
        $query->execute(array($session->getUserID(), $session->getHash()));
        return $con->lastInsertId();
    }

    static function updateSession(Session $session) {
        $query = self::connect()->prepare("UPDATE "
                . "users_session "
                . "SET "
                . "hash = ? "
                . "WHERE sessionID = ?");
        return $query->execute(array(
                    $session->getUserID(),
                    $session->getHash(),
                    $session->getSessionID()
        ));
    }

    static function deleteSession($sessionID) {
        $query = self::connect()->prepare("DELETE FROM users_session WHERE sessionID = ?");
        return $query->execute($sessionID);
    }
    static function getSession($col, $val) {
        try {
            $query = self::connect()->prepare("SELECT * FROM users_session WHERE " . $col . " = ?");
            $query->execute(array($val));
            $session = $query->fetchObject('Session');
            return $session;
        } catch (PDOException $ex) {
            
        }
    }

    static function updateDetails(User $user) {
        $query = self::connect()->prepare("UPDATE "
                . "Users "
                . "SET "
                . "name = ?, email = ?, location = ?, sex = ?"
                . "WHERE UserID = ?");
        return $query->execute(array(
                    $user->getName(),
                    $user->getEmail(),
                    $user->getLocation(),
                    $user->getSex(),
                    $user->getUserID()
                    
        ));
    }
    
    static function addNews(News $news){
        $con = self::connect();
        $query = $con->prepare("INSERT INTO "
                . "News "
                . "(newsTitle, newsBody, UserID, datePosted) "
                . "VALUES (?,?,?,?)");
        $query->execute(array($news->getNewsTitle(), $news->getNewsBody(), $news->getUserID(), $news->getDatePosted()));
    }
    
    static function getNews() {
        $query = self::connect()->prepare("SELECT 
            Users.username,
            Users.userID,
            News.NewsID,
            News.newsTitle,
            News.datePosted,
            News.newsBody
            FROM News 
            JOIN Users ON News.userID = Users.userID 
            ORDER BY newsID DESC 
            LIMIT 3");
        $query->execute();
        return $query->fetchAll();
    }    
}
