/*  
    SCRIPT DE CRIAÇÃO DO BANCO DO SISTEMA
*/

DROP TABLE IF EXISTS fds.tbl_group_user;
DROP TABLE IF EXISTS fds.tbl_command_node;
DROP TABLE IF EXISTS fds.tbl_user;
DROP TABLE IF EXISTS fds.tbl_person;
DROP TABLE IF EXISTS fds.tbl_group;
DROP TABLE IF EXISTS fds.tbl_node;
DROP TABLE IF EXISTS fds.tbl_command;
DROP TABLE IF EXISTS fds.tbl_session;

CREATE TABLE fds.tbl_person (
    per_in_id INT NOT NULL AUTO_INCREMENT,
    per_st_name VARCHAR(45) NOT NULL,
    per_st_shortname VARCHAR(15) NULL,
    per_st_email VARCHAR(45) NOT NULL,
    per_bo_status BIT NULL DEFAULT 1,
    per_ts_alter TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
    usr_in_id_ctrl INT NOT NULL DEFAULT 1,
    PRIMARY KEY (per_in_id),
    UNIQUE KEY (per_st_email)
);


CREATE TABLE fds.tbl_user (
    usr_in_id INT NOT NULL AUTO_INCREMENT,
    usr_st_login VARCHAR(45) NOT NULL,
    usr_st_password VARCHAR(45) NULL,
    usr_bo_status BIT NULL DEFAULT 1,
    per_in_id INT NOT NULL,
    usr_ts_alter TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
    usr_in_id_ctrl INT NOT NULL DEFAULT 1,
    PRIMARY KEY (usr_in_id),
    UNIQUE KEY (per_in_id),
    UNIQUE KEY (usr_st_login),
    FOREIGN KEY (per_in_id) REFERENCES fds.tbl_person (per_in_id) ON DELETE RESTRICT ON UPDATE CASCADE
);


CREATE TABLE fds.tbl_group (
    grp_in_id INT NOT NULL AUTO_INCREMENT,
    grp_st_label VARCHAR(45) NOT NULL,
    grp_bo_status BIT NULL DEFAULT 1,
    grp_ts_alter TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
    usr_in_id_ctrl INT NOT NULL DEFAULT 1,
    PRIMARY KEY (grp_in_id)
);


CREATE TABLE fds.tbl_group_user (
    gru_in_id INT NOT NULL AUTO_INCREMENT,
    grp_in_id INT NOT NULL,
    usr_in_id INT NOT NULL,
    gru_ts_alter TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
    usr_in_id_ctrl INT NOT NULL DEFAULT 1,
    PRIMARY KEY (gru_in_id),
    UNIQUE KEY (grp_in_id , usr_in_id),
    FOREIGN KEY (grp_in_id) REFERENCES fds.tbl_group (grp_in_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (usr_in_id) REFERENCES fds.tbl_user (usr_in_id) ON DELETE RESTRICT ON UPDATE CASCADE
);


CREATE TABLE fds.tbl_node (
    nod_in_id INT NOT NULL AUTO_INCREMENT,
    nod_st_label VARCHAR(45) NOT NULL,
    nod_st_path VARCHAR(45) NOT NULL,
    nod_in_id_parent integer,
    nod_ts_open TIMESTAMP NULL,
    nod_ts_close TIMESTAMP NULL,
    nod_bo_status BIT NULL DEFAULT 1,
    nod_ts_alter TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
    usr_in_id_ctrl INT NOT NULL DEFAULT 1,
    PRIMARY KEY (nod_in_id)
);


CREATE TABLE fds.tbl_command (
    com_in_id INT NOT NULL AUTO_INCREMENT,
    com_st_label VARCHAR(45) NOT NULL,
    com_st_path VARCHAR(45) NOT NULL,
    com_ts_open TIMESTAMP NULL,
    com_ts_close TIMESTAMP NULL,
    com_bo_status BIT NULL DEFAULT 1,
    com_ts_alter TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
    usr_in_id_ctrl INT NOT NULL DEFAULT 1,
    PRIMARY KEY (com_in_id)
);


CREATE TABLE fds.tbl_command_node (
    con_in_id INT NOT NULL AUTO_INCREMENT,
    com_in_id INT NOT NULL,
    nod_in_id INT NOT NULL,
    con_ts_open TIMESTAMP NULL,
    con_ts_close TIMESTAMP NULL,
    con_bo_status BIT NULL DEFAULT 1,
    con_ts_alter TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
    usr_in_id_ctrl INT NOT NULL DEFAULT 1,
    PRIMARY KEY (con_in_id),
    FOREIGN KEY (com_in_id) REFERENCES fds.tbl_command (com_in_id) ON DELETE RESTRICT ON UPDATE CASCADE,
    FOREIGN KEY (nod_in_id) REFERENCES fds.tbl_node (nod_in_id) ON DELETE RESTRICT ON UPDATE CASCADE
);


CREATE TABLE fds.tbl_session(
  sess_in_id INT NOT NULL AUTO_INCREMENT,
  sess_ts_alter TIMESTAMP DEFAULT NOW() ON UPDATE NOW(),
  sess_ts_final TIMESTAMP NULL,
  usr_in_id INT NOT NULL,
  PRIMARY KEY(sess_in_id),
  FOREIGN KEY (usr_in_id) REFERENCES fds.tbl_user(usr_in_id) ON DELETE RESTRICT ON UPDATE CASCADE
);



SET NAMES UTF8;
/* Adicionando o Usuario Admin */
INSERT INTO fds.tbl_person (per_st_name, per_st_shortname, per_st_email)
    VALUES ( 'Administrador do Sistema', 'Admin', 'admin@admin.net');
INSERT INTO fds.tbl_user (usr_st_login, usr_st_password, per_in_id)
    VALUES ( 'admin', md5('admin123'), LAST_INSERT_ID());
