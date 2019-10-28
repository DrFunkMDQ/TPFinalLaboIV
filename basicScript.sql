create database moviePass;

use moviePass;

create table cinemas(
	id_cinema int unsigned auto_increment,
    cinema_name nvarchar(20) not null,
    cinema_address nvarchar(30),
    cinema_capacity int unsigned not null,
    cinema_ticket_price float unsigned not null,
constraint pk_id_cinema primary key (id_cinema)
);

create table movies(
	id_movie int unsigned,
    movie_name nvarchar(30) not null,
    movie_overview nvarchar(100),
    movie_language nvarchar(16),
    movie_image nvarchar(30),
	movie_traier nvarchar(20),
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
    show_room_name nvarchar(20) not null,
    id_cinema int unsigned,    
    show_room_capacity int unsigned not null,    
constraint pk_id_show_room primary key (id_show_room),
constraint fk_id_cinema foreign key (id_cinema) references movies (id_cinema)
);

create table roles(
    id_role int unsigned auto_increment,
    role_name varchar(30) not null,
constraint pk_id_role primary key (id_role)
);
    
create table users(
	id_user int unsigned auto_increment,
    id_role int unsigned default 2,
    user_name varchar(30) not null,
	user_last_name varchar(30) not null,
    user_birthday date not null,
    user_email varchar(120) not null,
    user_password varchar(255) not null,
constraint pk_id_user primary key (id_user),
constraint fk_id_role foreign key (id_role) references roles (id_role)
);

drop table users;
    