CREATE TABLE IF NOT EXISTS `role` (
    `roleID` int(11)  NOT NULL ,
    `role` VARCHAR(11)  NOT NULL ,
    PRIMARY KEY (
        `roleID`
    )
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `users` (
    `userID` int(11)  NOT NULL ,
    `firstName` VARCHAR(11)  NOT NULL ,
    `middleName` VARCHAR(11)  NOT NULL ,
    `lastName` VARCHAR(11)  NOT NULL ,
    `role` int(11)  NOT NULL ,
    `login` VARCHAR(11)  NOT NULL ,
    `password` VARCHAR(11)  NOT NULL ,
    PRIMARY KEY (
        `userID`
    )
)ENGINE=InnoDB DEFAULT CHARSET=utf8;



CREATE TABLE IF NOT EXISTS `tests` (
    `testID` int(11)  NOT NULL ,
    `name` VARCHAR(11)  NOT NULL ,
    `owner` int(11)  NOT NULL ,
    PRIMARY KEY (
        `testID`
    )
);


CREATE TABLE IF NOT EXISTS `questions` (
    `questionID` int(11)  NOT NULL ,
    `name` VARCHAR(11)  NOT NULL ,
    `answers` VARCHAR(11)  NOT NULL ,
    `test` int(11)  NOT NULL ,
    PRIMARY KEY (
        `questionID`
    ));


CREATE TABLE IF NOT EXISTS `solved_tests` (
    `solved_test_id` int(11)  NOT NULL ,
    `user` int(11)  NOT NULL ,
    `test` int(11)  NOT NULL ,
    `true_answers` int(11)  NOT NULL ,
    `false_answers` int(11)  NOT NULL ,
    `mark` int(11)  NULL ,
    PRIMARY KEY (
        `solved_test_id`
    ));

CREATE TABLE IF NOT EXISTS `answers` (
    `answerID` int(11)  NOT NULL ,
    `user` int(11)  NOT NULL ,
    `test` int(11)  NOT NULL ,
    `question` int(11)  NOT NULL ,
    `answer` VARCHAR(11)  NOT NULL ,
    `mark` BOOLEAN  NOT NULL ,
    PRIMARY KEY (
        `answerID`
    ))ENGINE=InnoDB DEFAULT CHARSET=utf8;

ALTER TABLE `users` ADD KEY `role` (`role`);
ALTER TABLE `tests` ADD KEY `owner` (`owner`);
ALTER TABLE `questions` ADD KEY `test` (`test`);
ALTER TABLE `solved_tests` ADD KEY `test` (`test`), ADD KEY `user` (`user`);
ALTER TABLE `answers` ADD KEY `test` (`test`), ADD KEY `user` (`user`), ADD KEY `question` (`question`);

    ALTER TABLE `tests` MODIFY `testID` int(11) NOT NULL AUTO_INCREMENT;
    ALTER TABLE `users` MODIFY `userID` int(11) NOT NULL AUTO_INCREMENT;
    ALTER TABLE `role` MODIFY `roleID` int(11) NOT NULL AUTO_INCREMENT;
    ALTER TABLE `questions` MODIFY `questionID` int(11) NOT NULL AUTO_INCREMENT;
    ALTER TABLE `solved_tests` MODIFY `solved_test_id` int(11) NOT NULL AUTO_INCREMENT;
    ALTER TABLE `answers` MODIFY `answerID` int(11) NOT NULL AUTO_INCREMENT;

-- ALTER TABLE `users` ADD CONSTRAINT `role` FOREIGN KEY (`role`) REFERENCES `role`(`roleID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
--
-- ALTER TABLE `tests` ADD CONSTRAINT `owner` FOREIGN KEY (`owner`) REFERENCES `users`(`userID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
--
-- ALTER TABLE `questions` ADD CONSTRAINT `test` FOREIGN KEY (`test`) REFERENCES `tests`(`testID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
--
-- -- ALTER TABLE `solved_tests` ADD CONSTRAINT `test` FOREIGN KEY (`test`) REFERENCES `tests`(`testID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
--
-- ALTER TABLE `solved_tests` ADD CONSTRAINT `user` FOREIGN KEY (`user`) REFERENCES `users`(`userID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
--
-- ALTER TABLE `answers` ADD CONSTRAINT `test` FOREIGN KEY (`test`) REFERENCES `tests`(`testID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
--
-- ALTER TABLE `answers` ADD CONSTRAINT `question` FOREIGN KEY (`question`) REFERENCES `questions`(`questionID`) ON DELETE RESTRICT ON UPDATE RESTRICT;
