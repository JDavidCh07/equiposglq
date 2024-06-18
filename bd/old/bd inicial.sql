DROP DATABASE IF EXISTS equiposglq;
CREATE DATABASE equiposglq;
USE equiposglq;

CREATE TABLE modulo (
    idmod int(5) NOT NULL,
    nommod varchar(100) NOT NULL,
    imgmod varchar(255) DEFAULT NULL,
    actmod tinyint(1) NOT NULL DEFAULT 1,
    idpag bigint(11) DEFAULT NULL
);

CREATE TABLE pagina (
    idpag bigint(11) NOT NULL,
    icono varchar(255) NOT NULL,
    nompag varchar(25) NOT NULL,
    arcpag varchar(100) NOT NULL,
    ordpag int(3) NOT NULL,
    menpag varchar(30) NOT NULL,
    mospag tinyint(1) DEFAULT NULL,
    idmod int(5) NOT NULL
);

CREATE TABLE pagxpef (
    idpag bigint(11) NOT NULL,
    idpef bigint(11) NOT NULL
);

CREATE TABLE perfil (
    idpef bigint(11) NOT NULL,
    nompef varchar(100) NOT NULL,
    idmod int(5) NOT NULL
);

CREATE TABLE perxpef (
    idper bigint(11) NOT NULL,
    idpef bigint(11) NOT NULL
); 

CREATE TABLE persona (
    idper bigint(11) NOT NULL,
    nomper varchar(100) NOT NULL,
    apeper varchar(100) NOT NULL,
    idvtpd bigint(11) NOT NULL,
    ndper varchar(12) NOT NULL,
    emaper varchar(255) NOT NULL,
    pasper text DEFAULT NULL,
    cargo varchar(100) NOT NULL,
    actper tinyint(1) DEFAULT 1
); 

INSERT INTO persona(idper, nomper, apeper, idvtpd, ndper, emaper, pasper, cargo, actper) VALUES (1, 'David', 'Chaparro', '1', 1072642921, 'david@galqui.com', '123456', 'Aprendiz Sena', 1); 

CREATE TABLE tarjeta (
    idtaj bigint(11) NOT NULL,
    numtajpar varchar(100) NULL,
    numtajofi varchar(100) NULL,
    idperent bigint(11) NOT NULL,
    idperrec bigint(11) NOT NULL,
    fecent date NULL,
    fecdev date NULL,
    esttaj tinyint(1) DEFAULT 1
);

CREATE TABLE valor (
    idval bigint(11) NOT NULL,
    nomval varchar(70) NOT NULL,
    iddom bigint(11) NOT NULL,
    actval tinyint(1) DEFAULT 1
);

CREATE TABLE dominio (
    iddom bigint(11) NOT NULL,
    nomdom varchar(70) NOT NULL
);

CREATE TABLE asignar (
    ideqxpr bigint(11) NOT NULL,
    idequ bigint(11) NOT NULL,
    idperent bigint(11) NOT NULL,
    idperrec bigint(11) NOT NULL,
    fecent date NULL,
    fecdev date NULL,
    observ varchar(512) NULL,
    estexp tinyint(1) DEFAULT 1   
);

CREATE TABLE equipo (
    idequ bigint(11) NOT NULL,
    marca varchar(50) NOT NULL,
    modelo varchar(50) NOT NULL,
    serialeq varchar(50) NOT NULL,
    nomred varchar(50) NOT NULL,
    idvarea bigint(11) NOT NULL, 
    idvtpeq bigint(11) NOT NULL, 
    idvgb bigint(11) NOT NULL,
    idvram bigint(11) NOT NULL,
    idvprc bigint(11) NOT NULL,
    fecultman date DEFAULT NULL,
    fecproman date DEFAULT NULL,
    actequ tinyint(1) DEFAULT 1,
    tipcon tinyint(1) DEFAULT 1,
    contrato varchar(250) DEFAULT NULL,
    valrcont float DEFAULT NULL
);

CREATE TABLE accxequi(
    idacxeq bigint(11) NOT NULL,
    idequ bigint(11) NOT NULL,
    idvacc bigint(11) NOT NULL
);

CREATE TABLE mantenimiento (
    idman bigint(11) NOT NULL,
    idequ bigint(11) NOT NULL,
    idvtpm bigint(11) NOT NULL,
    fecman date NULL,
    observ varchar(512) NULL
);

CREATE TABLE prgxequi (
    idprxeq bigint(11) NOT NULL,
    idequ bigint(11) NOT NULL,
    idvprg bigint(11) NOT NULL,
    otro varchar(512) NULL
);

ALTER TABLE modulo
    ADD PRIMARY KEY (idmod);

ALTER TABLE pagina
    ADD PRIMARY KEY (idpag),
    ADD KEY idmod (idmod);

ALTER TABLE pagxpef
    ADD KEY idpag (idpag),
    ADD KEY idpef (idpef);

ALTER TABLE perfil
    ADD PRIMARY KEY (idpef),
    ADD KEY idmod (idmod);

ALTER TABLE perxpef
    ADD KEY idper (idper),
    ADD KEY idpef (idpef);

ALTER TABLE persona
    ADD PRIMARY KEY (idper),
    ADD KEY idvtpd (idvtpd);

ALTER TABLE tarjeta
    ADD PRIMARY KEY (idtaj),
    ADD KEY idperent (idperent),
    ADD KEY idperrec (idperrec);

ALTER TABLE valor
    ADD PRIMARY KEY (idval),
    ADD KEY iddom (iddom);

ALTER TABLE dominio
    ADD PRIMARY KEY (iddom);

ALTER TABLE asignar
    ADD PRIMARY KEY (ideqxpr),
    ADD KEY idequ (idequ),
    ADD KEY idperent (idperent),
    ADD KEY idperrec (idperrec);

ALTER TABLE equipo
    ADD PRIMARY KEY (idequ),
    ADD KEY idvarea (idvarea),
    ADD KEY idvtpeq (idvtpeq),
    ADD KEY idvgb (idvgb),
    ADD KEY idvram (idvram),
    ADD KEY idvprc (idvprc);

ALTER TABLE accxequi
    ADD PRIMARY KEY (idacxeq),
    ADD KEY idequ (idequ),
    ADD KEY idvacc (idvacc);

ALTER TABLE mantenimiento
    ADD PRIMARY KEY (idman),
    ADD KEY idequ (idequ);

ALTER TABLE prgxequi
    ADD PRIMARY KEY (idprxeq),
    ADD KEY idequ (idequ),
    ADD KEY idvprg (idvprg);

ALTER TABLE modulo
    MODIFY idmod int(5) NOT NULL AUTO_INCREMENT;

ALTER TABLE pagina
    MODIFY idpag bigint(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE pagxpef
    MODIFY idpag bigint(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE perfil
    MODIFY idpef bigint(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE perxpef
    MODIFY idper bigint(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE persona
    MODIFY idper bigint(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE tarjeta
    MODIFY idtaj bigint(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE valor
    MODIFY idval bigint(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE dominio
    MODIFY iddom bigint(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE asignar
    MODIFY ideqxpr bigint(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE equipo
    MODIFY idequ bigint(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE accxequi
    MODIFY idacxeq bigint(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE mantenimiento
    MODIFY idman bigint(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE prgxequi
    MODIFY idprxeq bigint(11) NOT NULL AUTO_INCREMENT;

ALTER TABLE pagina
    ADD CONSTRAINT pagina_ibfk_1 FOREIGN KEY (idmod) REFERENCES modulo (idmod);

ALTER TABLE perfil
    ADD CONSTRAINT perfil_ibfk_1 FOREIGN KEY (idmod) REFERENCES modulo (idmod);

ALTER TABLE pagxpef
    ADD CONSTRAINT pagxpef_ibfk_1 FOREIGN KEY (idpag) REFERENCES pagina (idpag),
    ADD CONSTRAINT pagxpef_ibfk_2 FOREIGN KEY (idpef) REFERENCES perfil (idpef);

ALTER TABLE perxpef
    ADD CONSTRAINT perxpef_ibfk_1 FOREIGN KEY (idper) REFERENCES persona (idper),
    ADD CONSTRAINT perxpef_ibfk_2 FOREIGN KEY (idpef) REFERENCES perfil (idpef);

ALTER TABLE tarjeta
    ADD CONSTRAINT tarjeta_ibfk_1 FOREIGN KEY (idperent) REFERENCES persona (idper),
    ADD CONSTRAINT tarjeta_ibfk_2 FOREIGN KEY (idperrec) REFERENCES persona (idper);

ALTER TABLE valor
    ADD CONSTRAINT valor_ibfk_1 FOREIGN KEY (iddom) REFERENCES dominio (iddom);

ALTER TABLE asignar
    ADD CONSTRAINT asignar_ibfk_1 FOREIGN KEY (idequ) REFERENCES equipo (idequ),
    ADD CONSTRAINT asignar_ibfk_2 FOREIGN KEY (idperent) REFERENCES persona (idper),
    ADD CONSTRAINT asignar_ibfk_3 FOREIGN KEY (idperrec) REFERENCES persona (idper);

ALTER TABLE accxequi
    ADD CONSTRAINT accxequi__ibfk_1 FOREIGN KEY (idequ) REFERENCES equipo (idequ);

ALTER TABLE mantenimiento
    ADD CONSTRAINT mantenimiento__ibfk_1 FOREIGN KEY (idequ) REFERENCES equipo (idequ);

ALTER TABLE prgxequi
    ADD CONSTRAINT prgxequi__ibfk_1 FOREIGN KEY (idequ) REFERENCES equipo (idequ);
