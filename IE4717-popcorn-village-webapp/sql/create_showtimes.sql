create table showtimes
( stid int unsigned not null primary key,
  mid int unsigned not null,
  takenseats text not null,
  dayofweek text not null,
  timeslot time not null
);