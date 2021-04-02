insert into groups (name,description,active) values ('cliente', 'comprador', 1), ('aliado', 'vendedor', 1) , ('superadmin', 'control', 1);

insert into users (code,name,surname,date_birth,phone,direction,active,email,password,group_id)
        values ('12345', 'pepito', 'perez', '1990/10/02', '3100000', 'cra 1', 1, 't@t.co', '12345', 1),
               ('67890', 'luis', 'duran', '1990/10/02', '3100000', 'cra 1', 1, 't2@t.co', '12345', 2),
               ('24680', 'ana', 'gomez', '1990/10/02', '3100000', 'cra 1', 1, 't3@t.co', '12345', 3),
               ('13579', 'maria', 'gonzalez', '1990/10/02', '3100000', 'cra 1', 1, 't4@t.co', '12345', 2),
               ('123890', 'lucia', 'gonzalez', '1990/10/02', '3100000', 'cra 1', 1, 't5@t.co', '12345', 2);

insert into states (name,acronym,active) values ('Norte Santander', 'NS', 1), ('Antioquia', 'AN', 1), ('Cundinamarca', 'CU', 1);

insert into cities (name,photo,acronym,active,state_id) values ('Pamplona', '1.jpg', 'PA', 1, 1), ('Medellin', '1.jpg', 'ME', 1, 2), ('Bogota', '1.jpg', 'BO', 1, 3);

insert into partners (name,logo,phone,direction,neighbor,email,description,available,active,user_id,city_id) values
                     ('aliado1', '1.jpg', '2222', 'cr 2', 'centro', 'aliad@t.co', 'gsd', 1, 1, 2, 1),
                     ('aliado2', '1.jpg', '2222', 'cr 2', 'centro', 'aliad2@t.co', 'gsd', 1, 1, 4, 2),
                     ('aliado3', '1.jpg', '2222', 'cr 2', 'centro', 'aliad3@t.co', 'gsd', 1, 1, 5, 3);

insert into state_sales (name,description,active) values ('Cotización', 'Pendiente por conversar con cliente', 1), ('Reserva', 'Reservada con el aliado', 1);

insert into sales (date_start,date_end,description,state_sale_id,user_id) values
                  ('2021/01/12', '2021/01/25', 'montaña', 1, 1),
                  ('2021/02/12', '2021/02/25', 'montaña', 1, 1),
                  ('2021/03/12', '2021/03/25', 'montaña', 1, 1);

insert into type_services (name,photo,description,active) values
                          ('Turismo Científico', '1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1),
                          ('Turismo de Aventura', '1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1),
                          ('Turismo Rural', '1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum', 1);

insert into type_rooms (name,description,active) values ('Normal', 'sdfsdfsd', 1), ('Especial', 'jasjsjd', 1);

insert into rooms (name,photo,description,active,price,type_room_id, partner_id) values
                  ('101', '1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 1, 50000, 1, 1),
                  ('102', '1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 1, 70000, 2, 2),
                  ('103', '1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 1, 70000, 2, 3);

insert into services (name,description,active,price,photo,partner_id,type_service_id) values
                     ('Caminata', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 1, 2000000, '1.jpg', 1, 1),
                     ('Caminata', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 1, 2000000, '1.jpg', 2, 2),
                     ('Caminata', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 1, 2000000, '1.jpg', 3, 3);

insert into sale_service (sale_id,service_id) values
                         (1,1),
                         (2,2),
                         (3,3);

insert into room_service (room_id, service_id) values
                         (1, 1),
                         (2, 2),
                         (3, 3);

insert into album_services (photo,description,service_id) values
            ('1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 1),
            ('1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 2),
            ('1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 3);

insert into album_rooms (photo,description,room_id) values
            ('1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 1),
            ('1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 2),
            ('1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 3);

insert into comment_services (photo,description,service_id) values
            ('1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 1),
            ('1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 2),
            ('1.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit', 3);
