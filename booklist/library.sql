CREATE TABLE authors (
    authorid int(11) not null auto_increment,
    name varchar(55) not null default '',
    primary key (authorid)
) engine=innoDB DEFAULT CHARSET=utf8 auto_increment = 5;

insert into authors (authorid, name) VALUES
                                         (1,'J.R.R. Tolkien'),
                                         (2, 'Alex Haley'),
                                         (3, 'Tom Clancy'),
                                         (4, 'Issac Asimov');

CREATE TABLE books (
    bookid int(11) not null auto_increment,
    authorid int(11) not null default '0',
    title varchar(55) not null default '',
    ISBN varchar(25) not null default '',
    pub_year smallint(6) not null default '0',
    available tinyint(4) not null,
    primary key (bookid)
) engine=innoDB DEFAULT CHARSET = utf8 auto_increment = 19;

insert into books values
    (1, 1, 'The Two Towers', '0-261-10236-2', 1954, 1),
    (2, 1, 'The Return of The King', '0-261-10236-0', 1954, 1),
    (3, 2, 'Roots', '0-440-17464-3', 1974, 1),
    (4, 3, 'Rainbow Six', '0-425-17034-9', 1998, 1),
    (5, 3, 'Teeth of the Tiger', '0-399-15079-X', 2003, 1)
