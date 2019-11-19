create database moviePass;

use moviePass;

create table cinemas(
	id_cinema int unsigned auto_increment,
    cinema_name nvarchar(20) not null,
    cinema_address nvarchar(30),
    active boolean default 1
constraint pk_id_cinema primary key (id_cinema)
);

drop table movies;

create table movies(
	id_movie int unsigned,
    movie_name nvarchar(500) not null,
    movie_overview nvarchar(1500),
    movie_language nvarchar(16),
    movie_image nvarchar(500),
	movie_trailer nvarchar(50),
constraint pk_id_movie primary key (id_movie)
);

create table genres(
	id_genre int unsigned, 
    genre_name varchar(15),
constraint pk_id_genre primary key (id_genre)
);

create table movies_by_genres(
	id_movie_by_genre int unsigned auto_increment,
    id_movie int unsigned,
    id_genre int unsigned,
constraint pk_id_movie_by_genre primary key (id_movie_by_genre),
constraint fk_id_movie foreign key (id_movie) references movies (id_movie),
constraint fk_id_genre foreign key (id_genre) references genres (id_genre)
 );

create table ShowRooms(
	id_show_room int unsigned auto_increment,
    show_room_name nvarchar(100) not null,
    id_cinema int unsigned,    
    show_room_capacity int unsigned not null,
    ticket_price float unsigned not null,
    active_showroom boolean default 1,
constraint pk_id_show_room primary key (id_show_room),
constraint fk_id_cinema foreign key (id_cinema) references movies (id_cinema)
);

create table roles(
    id_role int auto_increment,
    role_name varchar(30) not null,
constraint pk_id_role primary key (id_role)
);
    
create table users(
	id_user int unsigned auto_increment,
    id_role int unsigned default 2,
    user_name varchar(30) not null,
	user_last_name varchar(30) not null,
    user_birthday date not null,
    user_email varchar(120) unique not null,
    user_password varchar(255) not null,
constraint pk_id_user primary key (id_user),
constraint fk_id_role foreign key (id_role) references roles (id_role)
);
use moviepass;
drop table users;

 create table Shows(
	id_show int unsigned auto_increment,
    show_date date not null,
    show_time time not null,
    active int not null DEFAULT 1, 
    id_movie int unsigned not null, 
    id_show_room int unsigned not null,    
constraint pk_id_show primary key (id_show),
constraint fk_id_movie foreign key (id_movie) references movies (id_movie),
constraint fk_id_show_room foreign key (id_show_room) references ShowRooms (id_show_room)
);


alter table tickets add column ticket_price float;
alter table cinemas add column active boolean default 1;


drop table users;

       
CREATE TABLE IF NOT EXISTS purchases ( 
  id_purchase int(11) unsigned auto_increment,   
  total decimal(6,2) NOT NULL,
  purchase_date date not null,
  id_user int unsigned not null, 
  constraint pk_id_purchase primary key (id_purchase),
  constraint fk_id_user foreign key (id_user) references users (id_user)  
);

CREATE TABLE IF NOT EXISTS tickets(
    id_ticket int unsigned auto_increment,
    id_show int unsigned not null,
    id_purchase int unsigned not null,
    state int not null DEFAULT 1,
	ticket_price float,
    constraint pk_id_ticket primary key (id_ticket),
    constraint fk_id_show foreign key (id_show) references Shows (id_show),
    constraint fk_id_purchase foreign key (id_purchase) references purchases (id_purchase)
);

alter table tickets add ticket_price float; 
    