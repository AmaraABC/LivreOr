/*create table users (
	id_user serial primary key,
	username varchar(50) not null,
	mot_de_passe varchar(255) not null,
	unique (username)
);

create table messages (
	id_messages serial primary key,
	contenu varchar(255) not null,
	creation timestamp default current_timestamp,
	id_usermsg int not null,
	foreign key (id_usermsg) references users(id_user)
);*/