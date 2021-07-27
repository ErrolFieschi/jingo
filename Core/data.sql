create table PREFIXEuser
(
    id        int auto_increment
        primary key,
    firstname varchar(55)                            not null,
    lastname  varchar(255)                           not null,
    email     varchar(320)                           not null,
    pwd       varchar(255)                           not null,
    country   char(2)    default 'fr'                not null,
    role      tinyint    default 0                   not null,
    isDeleted tinyint(1) default 0                   not null,
    status    tinyint    default 0                   not null,
    createdAt timestamp  default current_timestamp() not null,
    updatedAt timestamp                              null on update current_timestamp(),
    token     varchar(255)                           null,
    birthday  date                                   null
);

create table PREFIXEnavbar
(
    id   int auto_increment,
    code text null,
    form text null,
    constraint PREFIXEnavbar_id_uindex
        unique (id)
);

alter table PREFIXEnavbar
    add primary key (id);

create table PREFIXEpage
(
    id       int auto_increment,
    url      varchar(200) null,
    code     text         null,
    title    varchar(200) null,
    name     varchar(200) null,
    active   tinyint      not null,
    createby int          not null,
    meta     text         null,
    visible  tinyint      not null,
    constraint PREFIXEpage_id_uindex
        unique (id)
);

alter table PREFIXEpage
    add primary key (id);

create table PREFIXEtraining_tag
(
    id   int          not null
        primary key,
    name varchar(200) null
);

create table PREFIXEtraining
(
    id              int auto_increment
        primary key,
    title           varchar(200)                          null,
    update_date     datetime                              null,
    role            int                                   not null,
    active          int                                   not null,
    duration        int                                   null,
    createby        varchar(200)                          not null,
    create_date     timestamp default current_timestamp() not null,
    template        text                                  null,
    description     text                                  null,
    image           varchar(200)                          null,
    training_tag_id int                                   null,
    url             varchar(200)                          not null,
    constraint FK_training_tag
        foreign key (training_tag_id) references PREFIXEtraining_tag (id)
);

create table PREFIXEpart
(
    id          int auto_increment
        primary key,
    title       varchar(250)                          null,
    update_date datetime                              null,
    createby    varchar(255)                          null,
    order_part  int                                   null,
    icon        varchar(255)                          null,
    create_date timestamp default current_timestamp() not null,
    training_id int                                   not null,
    url         varchar(200)                          not null,
    constraint part_training_id_fk
        foreign key (training_id) references PREFIXEtraining (id)
);

create table PREFIXElesson
(
    id          int auto_increment
        primary key,
    createby    varchar(255)                          null,
    update_date datetime                              null,
    title       varchar(255)                          null,
    resume      text                                  null,
    image       varchar(255)                          null,
    code        text                                  null,
    icon        varchar(255)                          null,
    create_date timestamp default current_timestamp() not null,
    part_id     int                                   not null,
    url         varchar(200)                          not null,
    constraint PREFIXElesson_PREFIXEpart_id_fk
        foreign key (part_id) references PREFIXEpart (id)
);




