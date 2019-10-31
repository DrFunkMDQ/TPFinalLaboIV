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
    movie_name nvarchar(500) not null,
    movie_overview nvarchar(1500),
    movie_language nvarchar(16),
    movie_image nvarchar(500),
	movie_traier nvarchar(50),

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
constraint pk_id_show_room primary key (id_show_room),
constraint fk_id_cinema foreign key (id_cinema) references cinemas (id_cinema)
);

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

alter table movies add movie_active boolean default '0'; 
alter table ShowRooms add ticket_price float unsigned not null;
ALTER TABLE showrooms ADD active_showroom boolean default 1;

    