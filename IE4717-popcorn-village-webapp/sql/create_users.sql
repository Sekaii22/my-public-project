create table users
( usid int unsigned not null auto_increment primary key,
  username text not null,
  passwords varchar(40) not null,
  email text not null,
  discount text DEFAULT null,
  featured text DEFAULT null
);