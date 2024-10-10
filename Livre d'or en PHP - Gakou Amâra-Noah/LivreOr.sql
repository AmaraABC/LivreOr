/*create table users (
	id_user serial primary key,
	username varchar(40) not null,
	mot_de_passe varchar(50) not null,
	unique(username)
);

create table messages (
	id_msg serial primary key,
	msg_txt varchar,
	creation timestamp default current_timestamp,
	id_user int not null,
	foreign key (id_user) references users(id_user)
);*/