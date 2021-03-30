create TABLE  `account` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `fullname` VARCHAR(255) NOT NULL,
    `emailaddress` VARCHAR(255) NOT NULL,
    `psw` VARCHAR(255) NOT NULL,
    `uploads` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;

create TABLE `company` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `company_name` VARCHAR(255) NOT NULL,
    `company_location` VARCHAR(255) NOT NULL,
    `job_role` VARCHAR(255) NOT NULL,
    `job_time` VARCHAR(255) NOT NULL,
    `company_url` VARCHAR(255) NOT NULL,
    `job_description` TEXT,
    `account_id` INT NOT NULl,
    `uploads` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (account_id) REFERENCES `account`(id)
) ENGINE = InnoDB;



create TABLE  `newsletter` (
    `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    `newsletter_emailaddress` VARCHAR(255) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE = InnoDB;