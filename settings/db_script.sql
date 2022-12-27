CREATE TABLE areas(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del área',
    nombre VARCHAR(255) NOT NULL COMMENT 'Nombre del área de la empresa'
);

CREATE TABLE roles(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del rol',
    nombre VARCHAR(255) NOT NULL COMMENT 'Nombre del rol'
);

CREATE TABLE empleados(
	id INT NOT NULL PRIMARY KEY AUTO_INCREMENT COMMENT 'Identificador del empleado',
    nombre VARCHAR(255) NOT NULL COMMENT 'Nombre completo del empleado. Campo tipo Text. Solo debe permitir letras con o sin tilde y espacios. No se admiten caracteres especiales ni números. Obligatorio',
    email VARCHAR(255) NOT NULL COMMENT 'Correo electrónico del empleado. Campo de tipo Text|Email. Solo permite una estructura de correo. Obligatorio.',
    sexo CHAR(1) NOT NULL COMMENT 'Campo de tipo Radio Button. M para Masculino. F para Femenino. Obligatorio.',
    area_id INT NOT NULL COMMENT 'Area de la empresa a la que pertenece el empleado. Campo de tipo Select. Obligatorio.',
    boletin INT NOT NULL COMMENT '1 para Recibir boletín. 0 para No recibir boletín, Campo de tipo Checkbox. Opcional.', 
    descripcion TEXT NOT NULL COMMENT 'Se describe la experiencia del empleado. Campo de tipo textarea. Obligatorio.',
    FOREIGN KEY (area_id) REFERENCES areas(id)
);

CREATE TABLE empleado_rol(
	empleado_id INT NOT NULL COMMENT 'Identificador del empleado',
    rol_id INT NOT NULL COMMENT 'Identificador del rol',
    FOREIGN KEY (empleado_id) REFERENCES empleados(id),
    FOREIGN KEY (rol_id) REFERENCES roles(id)
);

INSERT INTO `roles`(`nombre`) VALUES ('Profesional de proyectos - Desarrollador'), ('Gerente estratégico'), ('Auxiliar administrativo');
INSERT INTO `areas`(`nombre`) VALUES ('Administración'), ('Producción'), ('Ventas'), ('Calidad');