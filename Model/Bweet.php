create table bweets (
    id int(11) unsigned NOT NULL auto_increment,
    created datetime NOT NULL,
    description text NOT NULL,
    user_id int(11) unsigned,
    PRIMARY KEY (`id`)
) DEFAULT CHARSET=utf8