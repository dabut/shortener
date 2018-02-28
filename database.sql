CREATE TABLE IF NOT EXISTS clicks (
  id int(11) NOT NULL AUTO_INCREMENT,
  route_id int(11) NOT NULL,
  ip text NOT NULL,
  timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

CREATE TABLE IF NOT EXISTS routes (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id text NOT NULL,
  request varchar(120) NOT NULL,
  route text NOT NULL,
  timestamp timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (id),
  UNIQUE KEY request (request)
);

CREATE TABLE IF NOT EXISTS users (
  id int(11) NOT NULL AUTO_INCREMENT,
  username text NOT NULL,
  password text NOT NULL,
  email text NOT NULL,
  PRIMARY KEY (id)
);