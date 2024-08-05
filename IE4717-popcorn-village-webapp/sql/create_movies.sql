create table movies
( mid int unsigned not null primary key,
  title text not null,
  thumbnail text not null,
  trailer text not null,
  genre text not null,
  rating text not null,
  duration text not null,
  sypnosis text not null,
  director text not null,
  casts text not null,
  release_on date not null,
  price float(4,2) not null
);