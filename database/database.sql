DROP DATABASE IF EXISTS vet;
CREATE DATABASE vet;
USE vet;

CREATE TABLE clinics (
  clinic_id integer PRIMARY KEY AUTO_INCREMENT,
  clinic varchar(255) DEFAULT NULL,
  address varchar(255) DEFAULT NULL,
  vet varchar(255) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  phone_number varchar(25) DEFAULT NULL
);

CREATE TABLE counter(
  counter_id integer PRIMARY KEY AUTO_INCREMENT,
  counter integer DEFAULT 1,
  year_number integer(10) UNSIGNED DEFAULT NULL
);

INSERT INTO counter (year_number) VALUES (YEAR(CURDATE()));

CREATE TABLE expenses(
  expense_id integer PRIMARY KEY AUTO_INCREMENT,
  description varchar(255) DEFAULT NULL,
  amount decimal(10,2) DEFAULT NULL,
  expense_date datetime DEFAULT current_timestamp()
);

CREATE TABLE species(
  specie_id integer PRIMARY KEY AUTO_INCREMENT,
  specie varchar(255) DEFAULT NULL
);

CREATE TABLE breeds (
  breed_id integer PRIMARY KEY AUTO_INCREMENT,
  breed varchar(255) DEFAULT NULL,
  fk_specie_id integer DEFAULT NULL
);

CREATE TABLE studies(
  study_id integer PRIMARY KEY AUTO_INCREMENT,
  study varchar(255) DEFAULT NULL,
  public_price decimal(10,2) DEFAULT NULL,
  vet_price decimal(10,2) DEFAULT NULL,
  form enum('NO','BIOQUÍMICA','HEMOGRAMA','TIEMPOS DE COAGULACIÓN','CITOLOGÍA','RASPADO CUTÁNEO','COPROPARASITOSCÓPICO','PRUEBAS CRUZADAS','ELISA','ANÁLISIS DE LÍQUIDOS','URIANÁLISIS','VALOR DE K') DEFAULT 'NO'
);

CREATE TABLE users(
  user_id integer PRIMARY KEY AUTO_INCREMENT,
  username varchar(255) DEFAULT NULL,
  password varchar(255) DEFAULT NULL,
  first_name varchar(255) DEFAULT NULL,
  last_name varchar(255) DEFAULT NULL
);

CREATE TABLE cases(
  case_id integer PRIMARY KEY AUTO_INCREMENT,
  case_number varchar(255) DEFAULT NULL,
  pet varchar(255) DEFAULT NULL,
  sex enum('SIN ESPECIFICAR','MACHO','MACHO ESTERILIZADO','HEMBRA','HEMBRA ESTERILIZADO') DEFAULT NULL,
  age varchar(25) DEFAULT NULL,
  body_condition_score enum('1/5','2/5','3/5','4/5','5/5') DEFAULT NULL,
  anamnesis varchar(500) DEFAULT NULL,
  treatment varchar(500) DEFAULT NULL,
  price_type enum('NORMAL','ESPECIAL') DEFAULT NULL,
  invoice enum('SÍ','NO') DEFAULT NULL,
  opening_date datetime DEFAULT current_timestamp(),
  payment_status enum('NO PAGADO','PARCIALMENTE PAGADO','PAGADO') DEFAULT 'NO PAGADO',
  payment_percentage decimal(10,0) DEFAULT 0,
  delivery_status enum('ENTREGADO','NO ENTREGADO') DEFAULT 'NO ENTREGADO',
  fk_breed_id integer DEFAULT NULL,
  fk_clinic_id integer DEFAULT NULL,
  fk_user_id integer DEFAULT NULL,
  FOREIGN KEY (fk_breed_id) REFERENCES breeds (breed_id),
  FOREIGN KEY (fk_clinic_id) REFERENCES clinics (clinic_id),
  FOREIGN KEY (fk_user_id) REFERENCES users (user_id)
);

CREATE TABLE payments(
  payment_id integer PRIMARY KEY AUTO_INCREMENT,
  payment decimal(10,2) DEFAULT NULL,
  payment_date datetime DEFAULT current_timestamp(),
  payment_type enum('EFECTIVO','TERMINAL BANCARIA','TRANSFERENCIA ELECTRÓNICA') DEFAULT NULL,
  fk_case_id integer DEFAULT NULL,
  FOREIGN KEY (fk_case_id) REFERENCES cases (case_id)
);

CREATE TABLE items(
  item_id integer PRIMARY KEY AUTO_INCREMENT,
  price decimal(10,2) DEFAULT NULL,
  item_date datetime DEFAULT current_timestamp(),
  fk_case_id integer DEFAULT NULL,
  fk_study_id integer DEFAULT NULL,
  FOREIGN KEY (fk_case_id) REFERENCES cases (case_id),
  FOREIGN KEY (fk_study_id) REFERENCES studies (study_id)
);

CREATE TABLE referencias(
  referencia_id integer PRIMARY KEY AUTO_INCREMENT,
  descripcion varchar(100) DEFAULT NULL,
  hematocrito varchar(20) DEFAULT NULL,
  eritrocitos varchar(20) DEFAULT NULL,
  hemoglobina varchar(20) DEFAULT NULL,
  vgm varchar(20) DEFAULT NULL,
  cgmh varchar(20) DEFAULT NULL,
  reticulocitos varchar(20) DEFAULT NULL,
  plaquetas varchar(20) DEFAULT NULL,
  solidos_totales varchar(20) DEFAULT NULL,
  fibrinogeno varchar(20) DEFAULT NULL,
  relacion_ptfib varchar(20) DEFAULT NULL,
  leucocitos varchar(20) DEFAULT NULL,
  neutrofilos varchar(20) DEFAULT NULL,
  bandas varchar(20) DEFAULT NULL,
  metamielocitos varchar(20) DEFAULT NULL,
  mielocitos varchar(20) DEFAULT NULL,
  linfocitos varchar(20) DEFAULT NULL,
  monocitos varchar(20) DEFAULT NULL,
  eosinofilos varchar(20) DEFAULT NULL,
  basofilos varchar(20) DEFAULT NULL,
  glucosa varchar(20) DEFAULT NULL,
  urea varchar(20) DEFAULT NULL,
  creatinina varchar(20) DEFAULT NULL,
  colesterol varchar(20) DEFAULT NULL,
  trigliceridos varchar(20) DEFAULT NULL,
  bilirrubina_total varchar(20) DEFAULT NULL,
  bilirrubina_conjugada varchar(20) DEFAULT NULL,
  bilirrubina_no_conjugada varchar(20) DEFAULT NULL,
  alanina_aminotransferasa varchar(20) DEFAULT NULL,
  aspartato_aminotransferasa varchar(20) DEFAULT NULL,
  fosfatasa_alcalina varchar(20) DEFAULT NULL,
  amilasa varchar(20) DEFAULT NULL,
  lipasa varchar(20) DEFAULT NULL,
  creatinacinasa varchar(20) DEFAULT NULL,
  glutamato_deshidrogenasa varchar(20) DEFAULT NULL,
  gamaglutamil_transferasa varchar(20) DEFAULT NULL,
  proteinas_totales varchar(20) DEFAULT NULL,
  albumina varchar(20) DEFAULT NULL,
  globulinas varchar(20) DEFAULT NULL,
  relacion_ag varchar(20) DEFAULT NULL,
  calcio varchar(20) DEFAULT NULL,
  fosforo varchar(20) DEFAULT NULL,
  potasio varchar(20) DEFAULT NULL,
  sodio varchar(20) DEFAULT NULL,
  relacion_nak varchar(20) DEFAULT NULL,
  cloro varchar(20) DEFAULT NULL,
  bicarbonato varchar(20) DEFAULT NULL,
  brecha_anionica varchar(20) DEFAULT NULL,
  diferencia_de_iones_fuertes varchar(20) DEFAULT NULL,
  osmolalidad varchar(20) DEFAULT NULL,
  amonio varchar(20) DEFAULT NULL,
  tiempo_de_tromboplastina varchar(20) DEFAULT NULL,
  tiempo_de_protrombina varchar(20) DEFAULT NULL,
  t4_libre varchar(20) DEFAULT NULL,
  fk_specie_id integer DEFAULT NULL,
  FOREIGN KEY (fk_specie_id) REFERENCES species (specie_id) 
);

CREATE TABLE hemogramas(
  hematocrito float DEFAULT NULL,
  eritrocitos float DEFAULT NULL,
  eritrocitos_calculados float GENERATED ALWAYS AS (eritrocitos / 100) VIRTUAL,
  hemoglobina float DEFAULT NULL,
  vgm_calculada float GENERATED ALWAYS AS (case when eritrocitos_calculados is null or eritrocitos_calculados = 0 then NULL else hematocrito / eritrocitos_calculados * 1000 end) VIRTUAL,
  cgmh_calculada float GENERATED ALWAYS AS (case when hematocrito is null or hematocrito = 0 then NULL else hemoglobina / hematocrito end) VIRTUAL,
  reticulocitos float DEFAULT NULL,
  reticulocito_1 float DEFAULT NULL,
  reticulocito_2 float DEFAULT NULL,
  reticulocito_3 float DEFAULT NULL,
  reticulocito_4 float DEFAULT NULL,
  reticulocito_5 float DEFAULT NULL,
  reticulocito_6 float DEFAULT NULL,
  reticulocito_7 float DEFAULT NULL,
  reticulocito_8 float DEFAULT NULL,
  reticulocito_9 float DEFAULT NULL,
  reticulocito_10 float DEFAULT NULL,
  reticulocitos_calculados float GENERATED ALWAYS AS (case when reticulocitos is null or reticulocitos = 0 then NULL else 1000 * (reticulocito_1 + reticulocito_2 + reticulocito_3 + reticulocito_4 + reticulocito_5 + reticulocito_6 + reticulocito_7 + reticulocito_8 + reticulocito_9 + reticulocito_10) / (reticulocitos * 4 * 10) * eritrocitos_calculados end) VIRTUAL,
  plaqueta_1 float DEFAULT NULL,
  plaqueta_2 float DEFAULT NULL,
  plaqueta_3 float DEFAULT NULL,
  plaqueta_4 float DEFAULT NULL,
  plaqueta_5 float DEFAULT NULL,
  plaquetas_calculadas float GENERATED ALWAYS AS ((plaqueta_1 + plaqueta_2 + plaqueta_3 + plaqueta_4 + plaqueta_5) / 5 * 20) VIRTUAL,
  solidos_totales float DEFAULT NULL,
  proteina_1 float DEFAULT NULL,
  proteina_2 float DEFAULT NULL,
  fibrinogeno_calculado float GENERATED ALWAYS AS (proteina_1 - proteina_2) VIRTUAL,
  relacion_ptfib_calculada float GENERATED ALWAYS AS (case when fibrinogeno_calculado is null or fibrinogeno_calculado = 0 then NULL else solidos_totales / fibrinogeno_calculado end) VIRTUAL,
  leucocitos float DEFAULT NULL,
  leucocitos_calculados float GENERATED ALWAYS AS (case when eritrocitos_nucleados >= 6 then leucocitos * 100 / (100 + 20) else leucocitos end) VIRTUAL,
  neutrofilos float DEFAULT NULL,
  neutrofilos_calculados float GENERATED ALWAYS AS (neutrofilos * leucocitos_calculados / 100) VIRTUAL,
  bandas float DEFAULT NULL,
  bandas_calculadas float GENERATED ALWAYS AS (bandas * leucocitos_calculados / 100) VIRTUAL,
  metamielocitos float DEFAULT NULL,
  metamielocitos_calculados float GENERATED ALWAYS AS (metamielocitos * leucocitos_calculados / 100) VIRTUAL,
  mielocitos float DEFAULT NULL,
  mielocitos_calculados float GENERATED ALWAYS AS (mielocitos * leucocitos_calculados / 100) VIRTUAL,
  linfocitos float DEFAULT NULL,
  linfocitos_calculados float GENERATED ALWAYS AS (linfocitos * leucocitos_calculados / 100) VIRTUAL,
  monocitos float DEFAULT NULL,
  monocitos_calculados float GENERATED ALWAYS AS (monocitos * leucocitos_calculados / 100) VIRTUAL,
  eosinofilos float DEFAULT NULL,
  eosinofilos_calculados float GENERATED ALWAYS AS (eosinofilos * leucocitos_calculados / 100) VIRTUAL,
  basofilos float DEFAULT NULL,
  basofilos_calculados float GENERATED ALWAYS AS (basofilos * leucocitos_calculados / 100) VIRTUAL,
  anisocitosis varchar(255) DEFAULT NULL,
  policromasia varchar(255) DEFAULT NULL,
  aglutinacion varchar(255) DEFAULT NULL,
  poiquilocitos varchar(255) DEFAULT NULL,
  neutrofilos_toxicos varchar(255) DEFAULT NULL,
  linfocitos_reactivos varchar(255) DEFAULT NULL,
  otros_hallazgos varchar(255) DEFAULT NULL,
  eritrocitos_nucleados float DEFAULT NULL,
  observaciones text DEFAULT NULL,
  interpretaciones text DEFAULT NULL,
  fk_item_id integer DEFAULT NULL,
  fk_referencia_id integer DEFAULT NULL,
  fecha date DEFAULT NULL,
  FOREIGN KEY (fk_item_id) REFERENCES items (item_id) ON DELETE CASCADE,
  FOREIGN KEY (fk_referencia_id) REFERENCES referencias (referencia_id)
);

CREATE TABLE citologias(
  descripcion_macroscopica_de_la_lesion text DEFAULT NULL,
  descripcion_citologica varchar(6000) DEFAULT 'En un fondo limpio se observa el siguiente porcentaje celular: \nCélula intermedia anucleada: \nCélula intermedia superficial: \nCélula intermedia: \nCélula parabasal:',
  interpretaciones text DEFAULT NULL,
  diagnostico text DEFAULT NULL,
  comentario text DEFAULT NULL,
  fk_item_id integer DEFAULT NULL,
  fecha date DEFAULT NULL,
  FOREIGN KEY (fk_item_id) REFERENCES items (item_id) ON DELETE CASCADE
);

CREATE TABLE coproparasitocopicos(
  prueba text DEFAULT NULL,
  resultado_1 text DEFAULT NULL,
  resultado_2 text DEFAULT NULL,
  resultado_3 text DEFAULT NULL,
  fecha_1 date DEFAULT NULL,
  fecha_2 date DEFAULT NULL,
  fecha_3 date DEFAULT NULL,
  fk_item_id integer DEFAULT NULL,
  FOREIGN KEY (fk_item_id) REFERENCES items (item_id) ON DELETE CASCADE
);

CREATE TABLE elisas(
  observaciones text DEFAULT NULL,
  ac_anaplasma enum('POSITIVO','NEGATIVO') DEFAULT NULL,
  ac_borrelia_burgdorferi enum('POSITIVO','NEGATIVO') DEFAULT NULL,
  ac_ehrlichia_canis enum('POSITIVO','NEGATIVO') DEFAULT NULL,
  ac_vif enum('POSITIVO','NEGATIVO') DEFAULT NULL,
  ag_dirofilaria_immitis enum('POSITIVO','NEGATIVO') DEFAULT NULL,
  ag_filaria enum('POSITIVO','NEGATIVO') DEFAULT NULL,
  ag_distemper_canino enum('POSITIVO','NEGATIVO') DEFAULT NULL,
  ag_levf enum('POSITIVO','NEGATIVO') DEFAULT NULL,
  ag_parvovirus enum('POSITIVO','NEGATIVO') DEFAULT NULL,
  fk_item_id integer DEFAULT NULL,
  fecha date DEFAULT NULL,
  FOREIGN KEY (fk_item_id) REFERENCES items (item_id) ON DELETE CASCADE
);

CREATE TABLE bioquimicas(
  glucosa float DEFAULT NULL,
  glucosa_calculada float GENERATED ALWAYS AS (glucosa * 0.05551) VIRTUAL,
  urea float DEFAULT NULL,
  creatinina float DEFAULT NULL,
  creatinina_calculada float GENERATED ALWAYS AS (creatinina * 88.4) VIRTUAL,
  colesterol float DEFAULT NULL,
  trigliceridos float DEFAULT NULL,
  bilirrubina_total float DEFAULT NULL,
  bilirrubina_total_calculada float GENERATED ALWAYS AS (bilirrubina_total * 17.1) VIRTUAL,
  bilirrubina_conjugada float DEFAULT NULL,
  bilirrubina_no_conjugada_calculada float GENERATED ALWAYS AS (case when bilirrubina_total_calculada > bilirrubina_conjugada then bilirrubina_total_calculada - bilirrubina_conjugada else bilirrubina_conjugada - bilirrubina_total_calculada end) VIRTUAL,
  alanina_aminotransferasa float DEFAULT NULL,
  aspartato_aminotransferasa float DEFAULT NULL,
  fosfatasa_alcalina float DEFAULT NULL,
  amilasa float DEFAULT NULL,
  lipasa float DEFAULT NULL,
  creatinacinasa float DEFAULT NULL,
  glutamato_deshidrogenasa float DEFAULT NULL,
  gamaglutamil_transferasa float DEFAULT NULL,
  proteinas_totales float DEFAULT NULL,
  albumina float DEFAULT NULL,
  albumina_minima_normal float DEFAULT NULL,
  globulinas_calculadas float GENERATED ALWAYS AS (proteinas_totales - albumina) VIRTUAL,
  relacion_ag_calculada float GENERATED ALWAYS AS (case when globulinas_calculadas is null or globulinas_calculadas = 0 then NULL else albumina / globulinas_calculadas end) VIRTUAL,
  calcio float DEFAULT NULL,
  calcio_calculado float GENERATED ALWAYS AS (case when calcio * 0.23 <= calcio_minimo_normal and albumina <= albumina_minima_normal then (35 - albumina) / 40 + calcio * 0.23 else calcio * 0.23 end) VIRTUAL,
  fosforo float DEFAULT NULL,
  fosforo_calculada float GENERATED ALWAYS AS (fosforo * 0.32) VIRTUAL,
  potasio float DEFAULT NULL,
  sodio float DEFAULT NULL,
  relacion_nak_calculada float GENERATED ALWAYS AS (case when potasio is null or potasio = 0 then NULL else sodio / potasio end) VIRTUAL,
  cloro float DEFAULT NULL,
  bicarbonato float DEFAULT NULL,
  brecha_anionica_calculada float GENERATED ALWAYS AS (sodio + potasio - (cloro + bicarbonato)) VIRTUAL,
  diferencia_de_iones_fuertes_calculada float GENERATED ALWAYS AS (sodio - cloro) VIRTUAL,
  osmolalidad_calculada float GENERATED ALWAYS AS ((sodio + potasio) * 2) VIRTUAL,
  amonio float DEFAULT NULL,
  observaciones text DEFAULT NULL,
  interpretaciones text DEFAULT NULL,
  fk_item_id integer DEFAULT NULL,
  fk_referencia_id integer DEFAULT NULL,
  fecha date DEFAULT NULL,
  calcio_minimo_normal float DEFAULT NULL,
  calcio_maximo_normal float DEFAULT NULL,
  FOREIGN KEY (fk_item_id) REFERENCES items (item_id) ON DELETE CASCADE,
  FOREIGN KEY (fk_referencia_id) REFERENCES referencias (referencia_id)
);

CREATE TABLE k(
  colesterol float DEFAULT NULL,
  t4_libre float DEFAULT NULL,
  diagnostico text DEFAULT NULL,
  k float GENERATED ALWAYS AS (0.7 * t4_libre - colesterol) VIRTUAL,
  valores_de_referencia text DEFAULT NULL,
  fk_item_id integer DEFAULT NULL,
  fk_referencia_id integer DEFAULT NULL,
  fecha date DEFAULT NULL,
  FOREIGN KEY (fk_item_id) REFERENCES items (item_id) ON DELETE CASCADE,
  FOREIGN KEY (fk_referencia_id) REFERENCES referencias (referencia_id)
);

CREATE TABLE liquidos(
  tipo_de_liquido varchar(255) DEFAULT NULL,
  apariencia varchar(255) DEFAULT NULL,
  color varchar(255) DEFAULT NULL,
  hematocrito varchar(255) DEFAULT NULL,
  creatinina varchar(255) DEFAULT NULL,
  colesterol varchar(255) DEFAULT NULL,
  trigliceridos varchar(255) DEFAULT NULL,
  bilirrubina varchar(255) DEFAULT NULL,
  proteinas varchar(255) DEFAULT NULL,
  albumina varchar(255) DEFAULT NULL,
  conteo_celular varchar(255) DEFAULT NULL,
  viscocidad varchar(255) DEFAULT NULL,
  prueba_de_mucina varchar(255) DEFAULT NULL,
  prueba_de_pandy varchar(255) DEFAULT NULL,
  descripcion_microscopica text DEFAULT NULL,
  interpretaciones text DEFAULT NULL,
  diagnostico text DEFAULT NULL,
  comentario text DEFAULT NULL,
  fk_item_id integer DEFAULT NULL,
  globulinas varchar(255) DEFAULT NULL,
  relacion_ag varchar(255) DEFAULT NULL,
  fecha date DEFAULT NULL,
  FOREIGN KEY (fk_item_id) REFERENCES items (item_id) ON DELETE CASCADE
);

CREATE TABLE pruebas(
  hematocrito float DEFAULT NULL,
  donador_1 varchar(255) DEFAULT NULL,
  hematocrito_donador_1 varchar(255) DEFAULT NULL,
  prueba_mayor_apariencia_donador_1 varchar(255) DEFAULT NULL,
  prueba_menor_apariencia_donador_1 varchar(255) DEFAULT NULL,
  prueba_mayor_agregados_celulares_donador_1 varchar(255) DEFAULT NULL,
  prueba_menor_agregados_celulares_donador_1 varchar(255) DEFAULT NULL,
  prueba_mayor_aglutinacion_donador_1 varchar(255) DEFAULT NULL,
  prueba_menor_aglutinacion_donador_1 varchar(255) DEFAULT NULL,
  observaciones_donador_1 text DEFAULT NULL,
  donador_2 varchar(255) DEFAULT NULL,
  hematocrito_donador_2 varchar(255) DEFAULT NULL,
  prueba_mayor_apariencia_donador_2 varchar(255) DEFAULT NULL,
  prueba_menor_apariencia_donador_2 varchar(255) DEFAULT NULL,
  prueba_mayor_agregados_celulares_donador_2 varchar(255) DEFAULT NULL,
  prueba_menor_agregados_celulares_donador_2 varchar(255) DEFAULT NULL,
  prueba_mayor_aglutinacion_donador_2 varchar(255) DEFAULT NULL,
  prueba_menor_aglutinacion_donador_2 varchar(255) DEFAULT NULL,
  observaciones_donador_2 text DEFAULT NULL,
  donador_3 varchar(255) DEFAULT NULL,
  hematocrito_donador_3 varchar(255) DEFAULT NULL,
  prueba_mayor_apariencia_donador_3 varchar(255) DEFAULT NULL,
  prueba_menor_apariencia_donador_3 varchar(255) DEFAULT NULL,
  prueba_mayor_agregados_celulares_donador_3 varchar(255) DEFAULT NULL,
  prueba_menor_agregados_celulares_donador_3 varchar(255) DEFAULT NULL,
  prueba_mayor_aglutinacion_donador_3 varchar(255) DEFAULT NULL,
  prueba_menor_aglutinacion_donador_3 varchar(255) DEFAULT NULL,
  observaciones_donador_3 text DEFAULT NULL,
  donador_4 varchar(255) DEFAULT NULL,
  hematocrito_donador_4 varchar(255) DEFAULT NULL,
  prueba_mayor_apariencia_donador_4 varchar(255) DEFAULT NULL,
  prueba_menor_apariencia_donador_4 varchar(255) DEFAULT NULL,
  prueba_mayor_agregados_celulares_donador_4 varchar(255) DEFAULT NULL,
  prueba_menor_agregados_celulares_donador_4 varchar(255) DEFAULT NULL,
  prueba_mayor_aglutinacion_donador_4 varchar(255) DEFAULT NULL,
  prueba_menor_aglutinacion_donador_4 varchar(255) DEFAULT NULL,
  observaciones_donador_4 text DEFAULT NULL,
  donador_5 varchar(255) DEFAULT NULL,
  hematocrito_donador_5 varchar(255) DEFAULT NULL,
  prueba_mayor_apariencia_donador_5 varchar(255) DEFAULT NULL,
  prueba_menor_apariencia_donador_5 varchar(255) DEFAULT NULL,
  prueba_mayor_agregados_celulares_donador_5 varchar(255) DEFAULT NULL,
  prueba_menor_agregados_celulares_donador_5 varchar(255) DEFAULT NULL,
  prueba_mayor_aglutinacion_donador_5 varchar(255) DEFAULT NULL,
  prueba_menor_aglutinacion_donador_5 varchar(255) DEFAULT NULL,
  observaciones_donador_5 text DEFAULT NULL,
  interpretaciones text DEFAULT NULL,
  fk_item_id integer DEFAULT NULL,
  fk_referencia_id integer DEFAULT NULL,
  FOREIGN KEY (fk_item_id) REFERENCES items (item_id) ON DELETE CASCADE,
  FOREIGN KEY (fk_referencia_id) REFERENCES referencias (referencia_id)
);

CREATE TABLE raspados(
  resultado text DEFAULT NULL,
  fk_item_id integer DEFAULT NULL,
  fecha date DEFAULT NULL,
  FOREIGN KEY (fk_item_id) REFERENCES items (item_id) ON DELETE CASCADE
);

CREATE TABLE tiempos(
  tiempo_de_tromboplastina varchar(255) DEFAULT NULL,
  tiempo_de_protrombina varchar(255) DEFAULT NULL,
  interpretaciones text DEFAULT NULL,
  fk_item_id integer DEFAULT NULL,
  fk_referencia_id integer DEFAULT NULL,
  fecha date DEFAULT NULL,
  FOREIGN KEY (fk_item_id) REFERENCES items (item_id) ON DELETE CASCADE,
  FOREIGN KEY (fk_referencia_id) REFERENCES referencias (referencia_id)
);

CREATE TABLE urianalisis(
  metodo_de_obtencion enum('MICCIÓN','CATETERISMO','CISTOCENTESIS') NOT NULL,
  apariencia varchar(255) DEFAULT NULL,
  color varchar(255) DEFAULT NULL,
  densidad varchar(255) DEFAULT NULL,
  ph varchar(255) DEFAULT NULL,
  proteinas varchar(255) DEFAULT NULL,
  glucosa varchar(255) DEFAULT NULL,
  cetonas varchar(255) DEFAULT NULL,
  bilirrubina varchar(255) DEFAULT NULL,
  hemoglobina varchar(255) DEFAULT NULL,
  eritrocitos varchar(255) DEFAULT NULL,
  leucocitos varchar(255) DEFAULT NULL,
  celulas_epiteliales_transitorias varchar(255) DEFAULT NULL,
  celulas_epiteliales_escamosas varchar(255) DEFAULT NULL,
  cilindros varchar(255) DEFAULT NULL,
  tipo varchar(255) DEFAULT NULL,
  cristales varchar(255) DEFAULT NULL,
  bacterias varchar(255) DEFAULT NULL,
  lipidos varchar(255) DEFAULT NULL,
  otros varchar(255) DEFAULT NULL,
  interpretaciones text DEFAULT NULL,
  fk_item_id integer DEFAULT NULL,
  fecha date DEFAULT NULL,
  FOREIGN KEY (fk_item_id) REFERENCES items (item_id) ON DELETE CASCADE
);

DELIMITER $$
CREATE PROCEDURE DELIVER_CASE (IN p_case_id INTEGER)   BEGIN
    UPDATE cases SET
     delivery_status = 'ENTREGADO'
    WHERE case_id = p_case_id;
END$$

CREATE PROCEDURE DESTROY_BREED (IN p_breed_id INTEGER)   BEGIN
    DELETE FROM breeds WHERE breed_id = p_breed_id;
END$$

CREATE PROCEDURE DESTROY_CASE (IN p_case_id INTEGER)   BEGIN
    DELETE FROM cases WHERE case_id = p_case_id;
END$$

CREATE PROCEDURE DESTROY_CLINIC (IN p_clinic_id INTEGER)   BEGIN
    DELETE FROM clinics WHERE clinic_id = p_clinic_id;
END$$

CREATE PROCEDURE DESTROY_EXPENSE (IN p_expense_id INTEGER)   BEGIN
    DELETE FROM expenses WHERE expense_id = p_expense_id;
END$$

CREATE PROCEDURE DESTROY_ITEM (IN p_item_id INTEGER)   BEGIN
    DELETE FROM items WHERE item_id = p_item_id;
END$$

CREATE PROCEDURE DESTROY_PAYMENT (IN p_payment_id INTEGER)   BEGIN
    DELETE FROM payments WHERE payment_id = p_payment_id;
END$$

CREATE PROCEDURE DESTROY_REFERENCIA (IN p_referencia_id INTEGER)   BEGIN
    DELETE FROM referencias WHERE referencia_id = p_referencia_id;
END$$

CREATE PROCEDURE DESTROY_SPECIE (IN p_specie_id INTEGER)   BEGIN
    DELETE FROM species WHERE specie_id = p_specie_id;
END$$

CREATE PROCEDURE DESTROY_STUDY (IN p_study_id INTEGER)   BEGIN
    DELETE FROM studies WHERE study_id = p_study_id AND study_id > 42;
END$$

CREATE PROCEDURE DESTROY_USER (IN p_user_id INTEGER)   BEGIN
    DELETE FROM users WHERE user_id = p_user_id AND user_id != 1;
END$$

CREATE PROCEDURE INSERT_BREED (IN p_fk_specie_id INTEGER, IN p_breed VARCHAR(255))   BEGIN
    INSERT INTO breeds (breed, fk_specie_id) VALUES (UPPER(p_breed), p_fk_specie_id);
END$$

CREATE PROCEDURE INSERT_CASE (IN p_pet VARCHAR(255), IN p_sex ENUM('SIN ESPECIFICAR','MACHO','MACHO ESTERILIZADO','HEMBRA','HEMBRA ESTERILIZADO'), IN p_age VARCHAR(25), IN p_body_condition_score ENUM('1/5','2/5','3/5','4/5','5/5'), IN p_anamnesis VARCHAR(500), IN p_treatment VARCHAR(500), IN p_price_type ENUM('NORMAL','ESPECIAL'), IN p_invoice ENUM('SÍ','NO'), IN p_fk_breed_id INTEGER, IN p_fk_clinic_id INTEGER, IN p_fk_user_id INTEGER)   BEGIN
    DECLARE p_year_number INTEGER;
    DECLARE p_counter INTEGER;
    SET p_counter = (SELECT counter FROM counter WHERE counter_id = 1);
    SET p_year_number = (SELECT year_number FROM counter WHERE counter_id = 1);
    IF YEAR(CURDATE()) <> (p_year_number) THEN
        UPDATE counter SET counter = 1, year_number = YEAR(CURDATE()) WHERE counter_id = 1;
        SET p_year_number = (SELECT year_number FROM counter WHERE counter_id = 1);
        SET p_counter = (SELECT counter FROM counter WHERE counter_id = 1);
    END IF;
    INSERT INTO cases (case_number, pet, sex, age, body_condition_score, anamnesis, treatment, price_type, invoice, fk_breed_id, fk_clinic_id, fk_user_id) VALUES (CONCAT('C', (p_year_number % 100), LPAD(p_counter, 5, '0')), UPPER(p_pet), UPPER(p_sex), UPPER(p_age), p_body_condition_score, p_anamnesis, p_treatment, p_price_type, p_invoice, p_fk_breed_id, p_fk_clinic_id, p_fk_user_id);
    UPDATE counter SET counter = counter + 1 WHERE counter_id = 1;
    SELECT LAST_INSERT_ID() AS id;
END$$

CREATE PROCEDURE INSERT_CLINIC (IN p_clinic VARCHAR(255), IN p_address VARCHAR(255), IN p_vet VARCHAR(255), IN p_email VARCHAR(255), IN p_phone_number VARCHAR(25))   BEGIN
    INSERT INTO clinics (clinic, address, vet, email, phone_number) VALUES (UPPER(p_clinic), UPPER(p_address), UPPER(p_vet), LOWER(p_email), UPPER(p_phone_number));
END$$

CREATE PROCEDURE INSERT_EXPENSE (IN p_description VARCHAR(255), IN p_amount DECIMAL(10,2))   BEGIN
    INSERT INTO expenses (description, amount) VALUES (UPPER(p_description), p_amount);
END$$

CREATE PROCEDURE INSERT_ITEM (IN p_fk_case_id integer, IN p_fk_clinic_id integer, IN p_fk_study_id integer)   BEGIN
    DECLARE p_price_type ENUM('NORMAL', 'ESPECIAL');
    DECLARE p_price DECIMAL(10, 2);
    DECLARE p_divisible BOOLEAN;
    DECLARE p_form ENUM('NO', 'BIOQUÍMICA', 'HEMOGRAMA', 'TIEMPOS DE COAGULACIÓN', 'CITOLOGÍA', 'RASPADO CUTÁNEO', 'COPROPARASITOSCÓPICO', 'PRUEBAS CRUZADAS', 'ELISA', 'ANÁLISIS DE LÍQUIDOS', 'URIANÁLISIS', 'VALOR DE K');
    DECLARE p_item_id INTEGER;
    DECLARE p_item_counter INTEGER;
    
    SET p_price_type = (SELECT price_type FROM cases WHERE case_id = p_fk_case_id);
    SET p_form = (SELECT form FROM studies WHERE study_id = p_fk_study_id);
    
    IF p_price_type = 'NORMAL' THEN
        SET p_price = (SELECT public_price FROM studies WHERE study_id = p_fk_study_id);
    ELSE
        SET p_price = (SELECT vet_price FROM studies WHERE study_id = p_fk_study_id);
    END IF;

    INSERT INTO items (price, fk_case_id, fk_study_id) VALUES (p_price, p_fk_case_id, p_fk_study_id);
    SET p_item_id = LAST_INSERT_ID();

    IF p_form = 'BIOQUÍMICA' THEN
        INSERT INTO bioquimicas (fk_item_id) VALUES (p_item_id);
    END IF;
    IF p_form = 'HEMOGRAMA' THEN
        INSERT INTO hemogramas (fk_item_id) VALUES (p_item_id);
    END IF;
    IF p_form = 'TIEMPOS DE COAGULACIÓN' THEN
        INSERT INTO tiempos (fk_item_id) VALUES (p_item_id);
    END IF;
    IF p_form = 'CITOLOGÍA' THEN
        INSERT INTO citologias (fk_item_id) VALUES (p_item_id);
    END IF;
    IF p_form = 'RASPADO CUTÁNEO' THEN
        INSERT INTO raspados (fk_item_id) VALUES (p_item_id);
    END IF;
    IF p_form = 'COPROPARASITOSCÓPICO' THEN
        INSERT INTO coproparasitocopicos (fk_item_id) VALUES (p_item_id);
    END IF;
    IF p_form = 'PRUEBAS CRUZADAS' THEN
        INSERT INTO pruebas (fk_item_id) VALUES (p_item_id);
    END IF;
    IF p_form = 'ELISA' THEN
        INSERT INTO elisas (fk_item_id) VALUES (p_item_id);
    END IF;
    IF p_form = 'ANÁLISIS DE LÍQUIDOS' THEN
        INSERT INTO liquidos (fk_item_id) VALUES (p_item_id);
    END IF;
    IF p_form = 'URIANÁLISIS' THEN
        INSERT INTO urianalisis (fk_item_id) VALUES (p_item_id);
    END IF;
    IF p_form = 'VALOR DE K' THEN
        INSERT INTO k (fk_item_id) VALUES (p_item_id);
    END IF;
END$$

CREATE PROCEDURE INSERT_PAYMENT (IN p_payment DECIMAL(10,2), IN p_payment_type ENUM('EFECTIVO','TERMINAL BANCARIA','TRANSFERENCIA ELECTRÓNICA'), IN p_fk_case_id INTEGER)   BEGIN
    DECLARE p_invoice ENUM('SÍ', 'NO');
    DECLARE p_iva DECIMAL(10, 2);
    DECLARE p_subtotal DECIMAL(10, 2);
    DECLARE p_total DECIMAL(10, 2);
    DECLARE p_total_payments DECIMAL(10, 2);

    SET p_invoice = (SELECT invoice FROM cases WHERE case_id = p_fk_case_id);
    SET p_iva = (0.00);
    SET p_subtotal = (SELECT COALESCE(SUM(price), 0) FROM items WHERE fk_case_id = p_fk_case_id);
    SET p_total_payments = (SELECT COALESCE(SUM(payment), 0) FROM payments WHERE fk_case_id = p_fk_case_id);

    IF p_invoice = 'SÍ' THEN
        SET p_iva = p_subtotal * 0.16;
    END IF;
    SET p_total = p_subtotal + p_iva;

    IF (p_total_payments + p_payment) <= p_total AND p_total <> 0 THEN
        INSERT INTO payments (payment, payment_type, fk_case_id) VALUES (p_payment, p_payment_type, p_fk_case_id);
    END IF;
END$$

CREATE PROCEDURE INSERT_REFERENCIA (IN p_descripcion VARCHAR(100), IN p_hematocrito VARCHAR(20), IN p_eritrocitos VARCHAR(20), IN p_hemoglobina VARCHAR(20), IN p_vgm VARCHAR(20), IN p_cgmh VARCHAR(20), IN p_reticulocitos VARCHAR(20), IN p_plaquetas VARCHAR(20), IN p_solidos_totales VARCHAR(20), IN p_fibrinogeno VARCHAR(20), IN p_relacion_ptfib VARCHAR(20), IN p_leucocitos VARCHAR(20), IN p_neutrofilos VARCHAR(20), IN p_bandas VARCHAR(20), IN p_metamielocitos VARCHAR(20), IN p_mielocitos VARCHAR(20), IN p_linfocitos VARCHAR(20), IN p_monocitos VARCHAR(20), IN p_eosinofilos VARCHAR(20), IN p_basofilos VARCHAR(20), IN p_glucosa VARCHAR(20), IN p_urea VARCHAR(20), IN p_creatinina VARCHAR(20), IN p_colesterol VARCHAR(20), IN p_trigliceridos VARCHAR(20), IN p_bilirrubina_total VARCHAR(20), IN p_bilirrubina_conjugada VARCHAR(20), IN p_bilirrubina_no_conjugada VARCHAR(20), IN p_alanina_aminotransferasa VARCHAR(20), IN p_aspartato_aminotransferasa VARCHAR(20), IN p_fosfatasa_alcalina VARCHAR(20), IN p_amilasa VARCHAR(20), IN p_lipasa VARCHAR(20), IN p_creatinacinasa VARCHAR(20), IN p_glutamato_deshidrogenasa VARCHAR(20), IN p_gamaglutamil_transferasa VARCHAR(20), IN p_proteinas_totales VARCHAR(20), IN p_albumina VARCHAR(20), IN p_globulinas VARCHAR(20), IN p_relacion_ag VARCHAR(20), IN p_calcio VARCHAR(20), IN p_fosforo VARCHAR(20), IN p_potasio VARCHAR(20), IN p_sodio VARCHAR(20), IN p_relacion_nak VARCHAR(20), IN p_cloro VARCHAR(20), IN p_bicarbonato VARCHAR(20), IN p_brecha_anionica VARCHAR(20), IN p_diferencia_de_iones_fuertes VARCHAR(20), IN p_osmolalidad VARCHAR(20), IN p_amonio VARCHAR(20), IN p_tiempo_de_tromboplastina VARCHAR(20), IN p_tiempo_de_protrombina VARCHAR(20), IN p_t4_libre VARCHAR(20), IN p_fk_specie_id INTEGER)   BEGIN
    INSERT INTO referencias(
        descripcion, hematocrito, eritrocitos, hemoglobina, vgm, 
        cgmh, reticulocitos, plaquetas, solidos_totales, fibrinogeno, relacion_ptfib,
        leucocitos, neutrofilos, bandas, metamielocitos, mielocitos, 
        linfocitos, monocitos, eosinofilos, basofilos, glucosa,
        urea, creatinina, colesterol, trigliceridos, bilirrubina_total, 
        bilirrubina_conjugada, bilirrubina_no_conjugada, alanina_aminotransferasa, aspartato_aminotransferasa, fosfatasa_alcalina, 
        amilasa, lipasa, creatinacinasa, glutamato_deshidrogenasa, gamaglutamil_transferasa,
        proteinas_totales, albumina, globulinas, relacion_ag, calcio,
        fosforo, potasio, sodio, relacion_nak, cloro, bicarbonato, 
        brecha_anionica, diferencia_de_iones_fuertes, osmolalidad, amonio, tiempo_de_tromboplastina, tiempo_de_protrombina, t4_libre, fk_specie_id
    ) VALUES (
        UPPER(p_descripcion), p_hematocrito, p_eritrocitos, p_hemoglobina, p_vgm,
        p_cgmh, p_reticulocitos, p_plaquetas, p_solidos_totales, p_fibrinogeno, p_relacion_ptfib,
        p_leucocitos, p_neutrofilos, p_bandas, p_metamielocitos, p_mielocitos, 
        p_linfocitos, p_monocitos, p_eosinofilos, p_basofilos, p_glucosa, 
        p_urea, p_creatinina, p_colesterol, p_trigliceridos, p_bilirrubina_total, 
        p_bilirrubina_conjugada, p_bilirrubina_no_conjugada, p_alanina_aminotransferasa, p_aspartato_aminotransferasa, p_fosfatasa_alcalina, 
        p_amilasa, p_lipasa, p_creatinacinasa, p_glutamato_deshidrogenasa, p_gamaglutamil_transferasa,
        p_proteinas_totales, p_albumina, p_globulinas, p_relacion_ag, p_calcio,
        p_fosforo, p_potasio, p_sodio, p_relacion_nak, p_cloro, p_bicarbonato, 
        p_brecha_anionica, p_diferencia_de_iones_fuertes, p_osmolalidad, p_amonio, p_tiempo_de_tromboplastina, p_tiempo_de_protrombina, p_t4_libre, p_fk_specie_id
    );
END$$

CREATE PROCEDURE INSERT_SPECIE (IN p_specie VARCHAR(255))   BEGIN
    INSERT INTO species (specie) VALUES (UPPER(p_specie));
    SELECT LAST_INSERT_ID() AS id;
END$$

CREATE PROCEDURE INSERT_STUDY (IN p_study VARCHAR(255), IN p_public_price DECIMAL(10,2), IN p_vet_price DECIMAL(10,2))   BEGIN
    INSERT INTO studies (study, public_price, vet_price) VALUES (UPPER(p_study), p_public_price, p_vet_price);
END$$

CREATE PROCEDURE INSERT_USER (IN p_username VARCHAR(255), IN p_password VARCHAR(255), IN p_first_name VARCHAR(255), IN p_last_name VARCHAR(255))   BEGIN
    INSERT INTO users (username, password, first_name, last_name) VALUES (LOWER(p_username), p_password, UPPER(p_first_name), UPPER(p_last_name));
END$$

CREATE PROCEDURE SELECT_BIOQUIMICA (IN p_fk_item_id integer)   BEGIN
    SELECT
        fecha,
        glucosa,
        glucosa_calculada,
        urea,
        creatinina,
        creatinina_calculada,
        colesterol,
        trigliceridos,
        bilirrubina_total,
        bilirrubina_total_calculada,
        bilirrubina_conjugada,
        bilirrubina_no_conjugada_calculada,
        alanina_aminotransferasa,
        aspartato_aminotransferasa,
        fosfatasa_alcalina,
        amilasa,
        lipasa,
        creatinacinasa,
        glutamato_deshidrogenasa,
        gamaglutamil_transferasa,
        proteinas_totales,
        albumina,
        globulinas_calculadas,
        relacion_ag_calculada,
        calcio,
        calcio_calculado,
        fosforo,
        fosforo_calculada,
        potasio,
        sodio,
        relacion_nak_calculada,
        cloro,
        bicarbonato,
        brecha_anionica_calculada,
        diferencia_de_iones_fuertes_calculada,
        osmolalidad_calculada,
        amonio,
        interpretaciones,
        observaciones,
        fk_item_id,
        fk_referencia_id
    FROM 
        bioquimicas
    WHERE 
         fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE SELECT_BREED (IN p_breed_id INTEGER)   BEGIN
    SELECT breed_id, breed, fk_specie_id FROM breeds WHERE breed_id = p_breed_id;
END$$

CREATE PROCEDURE SELECT_BREEDS (IN p_specie_id INTEGER)   BEGIN
    SELECT breed_id, breed FROM breeds WHERE fk_specie_id = p_specie_id ORDER BY breed ASC;
END$$

CREATE PROCEDURE SELECT_CASE (IN p_case_id INTEGER)   BEGIN
    DECLARE p_invoice ENUM('SÍ', 'NO');
    DECLARE p_iva DECIMAL(10, 2);
    DECLARE p_subtotal DECIMAL(10, 2);
    DECLARE p_total DECIMAL(10, 2);
    DECLARE p_total_payments DECIMAL(10, 2);
    DECLARE p_debt DECIMAL(10, 2);
    DECLARE p_empty_items BOOLEAN;

    SET p_invoice = (SELECT invoice FROM cases WHERE case_id = p_case_id);
    SET p_iva = (0.00);
    SET p_subtotal = (SELECT COALESCE(SUM(price), 0) FROM items WHERE fk_case_id = p_case_id);
    SET p_total_payments = (SELECT COALESCE(SUM(payment), 0) FROM payments WHERE fk_case_id = p_case_id);

    IF p_invoice = 'SÍ' THEN
        SET p_iva = p_subtotal * 0.16;
    END IF;
    SET p_total = p_subtotal + p_iva;

    UPDATE cases SET payment_percentage = CASE WHEN p_total = 0 THEN 0 ELSE (p_total_payments * 100) / p_total END WHERE case_id = p_case_id;

    SET p_empty_items = (SELECT IF(COUNT(item_id)>0, FALSE, TRUE) FROM items WHERE fk_case_id = p_case_id);

    IF p_total_payments = 0 THEN
        UPDATE cases SET payment_status = 'NO PAGADO' WHERE case_id = p_case_id;
    END IF;

    IF p_total_payments >= p_total AND p_total_payments <> 0 THEN
        UPDATE cases SET payment_status = 'PAGADO' WHERE case_id = p_case_id;
        UPDATE cases SET payment_percentage = 100 WHERE case_id = p_case_id;
    END IF;

    IF p_total_payments < p_total AND p_total_payments <> 0 THEN
        UPDATE cases SET payment_status = 'PARCIALMENTE PAGADO' WHERE case_id = p_case_id;
    END IF;

    SET p_debt = (p_total - p_total_payments);

    SELECT 
        case_id,
        case_number, 
        pet, 
        sex, 
        age, 
        body_condition_score, 
        anamnesis, treatment, 
        price_type, 
        invoice, 
        opening_date,
        payment_status,
        delivery_status,
        fk_breed_id, 
        fk_clinic_id, 
        fk_user_id,
        CONCAT('$', COALESCE(p_subtotal, 0), ' MXN') AS subtotal,
        CONCAT('$', COALESCE(p_iva, 0), ' MXN') AS iva, 
        CONCAT('$', COALESCE(p_total, 0), ' MXN') AS total, 
        CONCAT('$', COALESCE(p_debt, 0), ' MXN') AS debt
    FROM cases WHERE case_id = p_case_id;
END$$

CREATE PROCEDURE SELECT_CASES_SUMMARY (IN p_case_number VARCHAR(255), IN p_page_number integer, IN p_cases_per_page integer)   BEGIN
    DECLARE p_offset INTEGER;
    SET p_offset = ((p_page_number - 1) * p_cases_per_page);
    SELECT 
        case_id, 
        case_number,
        opening_date,
        delivery_status,
        payment_status,
        IF(payment_percentage IS NULL, '', CONCAT(payment_percentage, '%')) AS payment_percentage
    FROM cases 
        WHERE 
            case_number LIKE CONCAT('%', p_case_number, '%') AND (payment_status <> 'PAGADO' OR delivery_status = 'NO ENTREGADO')
        ORDER BY case_id DESC LIMIT p_cases_per_page OFFSET p_offset;
END$$

CREATE PROCEDURE SELECT_CITOLOGIA (IN p_fk_item_id integer)   BEGIN
    SELECT
        fecha,
        descripcion_macroscopica_de_la_lesion,
        descripcion_citologica,
        interpretaciones,
        diagnostico,
        comentario,
        fk_item_id
    FROM
        citologias
    WHERE
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE SELECT_CLINIC (IN p_clinic_id INTEGER)   BEGIN
    SELECT clinic_id, clinic, address, vet, email, phone_number FROM clinics WHERE clinic_id = p_clinic_id;
END$$

CREATE PROCEDURE SELECT_CLINICS ()   BEGIN
    SELECT clinic_id, clinic, address FROM clinics ORDER BY clinic ASC;
END$$

CREATE PROCEDURE SELECT_COPROPARASITOSCOPICO (IN p_fk_item_id INTEGER)   BEGIN
    SELECT
        prueba,
        resultado_1,
        resultado_2,
        resultado_3,
        fecha_1,
        fecha_2,
        fecha_3,      
        fk_item_id
    FROM
        coproparasitocopicos
    WHERE
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE SELECT_ELISA (IN p_fk_item_id integer)   BEGIN
    SELECT
        fecha,
        observaciones,
        ac_anaplasma,
        ac_borrelia_burgdorferi,
        ac_ehrlichia_canis,
        ac_vif,
        ag_dirofilaria_immitis,
        ag_filaria,
        ag_distemper_canino,
        ag_levf,
        ag_parvovirus,
        fk_item_id
    FROM
        elisas
    WHERE
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE SELECT_EXPENSE (IN p_expense_id INTEGER)   BEGIN
    SELECT 
        expense_id, 
        description, 
        amount 
    FROM expenses WHERE expense_id = p_expense_id;
END$$

CREATE PROCEDURE SELECT_EXPENSES_SUMMARY (IN p_start_expense_date DATE, IN p_end_expense_date DATE)   BEGIN
SELECT COALESCE(SUM(amount), 0) AS expenses_summary FROM expenses WHERE DATE_SUB(expense_date, INTERVAL 6 HOUR) >= CONCAT(p_start_expense_date, ' 00:00:00') AND expense_date < CONCAT(p_end_expense_date, ' 23:59:59');
END$$

CREATE PROCEDURE SELECT_HEMOGRAMA (IN p_fk_item_id integer)   BEGIN
    SELECT
        fecha,
        hematocrito,
        eritrocitos,
        eritrocitos_calculados,
        hemoglobina,
        vgm_calculada,
        cgmh_calculada,
        reticulocitos,
        reticulocito_1,
        reticulocito_2,
        reticulocito_3,
        reticulocito_4,
        reticulocito_5,
        reticulocito_6,
        reticulocito_7,
        reticulocito_8,
        reticulocito_9,
        reticulocito_10,
        reticulocitos_calculados,
        plaqueta_1,
        plaqueta_2,
        plaqueta_3,
        plaqueta_4,
        plaqueta_5,
        plaquetas_calculadas,
        solidos_totales,
        proteina_1,
        proteina_2,
        fibrinogeno_calculado,
        relacion_ptfib_calculada,
        leucocitos,
        leucocitos_calculados,
        neutrofilos,
        neutrofilos_calculados,
        bandas,
        bandas_calculadas,
        metamielocitos,
        metamielocitos_calculados,
        mielocitos,
        mielocitos_calculados,
        linfocitos,
        linfocitos_calculados,
        monocitos,
        monocitos_calculados,
        eosinofilos,
        eosinofilos_calculados,
        basofilos,
        basofilos_calculados,
        anisocitosis,
        policromasia,
        aglutinacion,
        poiquilocitos,
        neutrofilos_toxicos,
        linfocitos_reactivos,
        otros_hallazgos,
        eritrocitos_nucleados,
        interpretaciones,
        observaciones,
        fk_item_id,
        fk_referencia_id
    FROM hemogramas
    WHERE 
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE SELECT_ITEM (IN p_item_id INTEGER)   BEGIN
    SELECT item_id, price, item_date, fk_case_id, fk_study_id FROM items WHERE item_id = p_item_id;
END$$

CREATE PROCEDURE SELECT_ITEMS (IN p_fk_case_id integer)   BEGIN
    SELECT 
        item_id, 
        study_id, 
        study, 
        item_date, 
        form, 
        CASE 
            WHEN price < 0 THEN CONCAT('-$', ABS(price), ' MXN')
            ELSE CONCAT('$', price, ' MXN') 
        END AS price 
    FROM items 
    INNER JOIN studies ON study_id = fk_study_id 
    WHERE fk_case_id = p_fk_case_id;
END$$

CREATE PROCEDURE SELECT_K (IN p_fk_item_id integer)   BEGIN
    SELECT
        fecha,
        colesterol,
        t4_libre,
        k,
        diagnostico,
        valores_de_referencia,
        fk_item_id,
        fk_referencia_id
    FROM
        k
    WHERE
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE SELECT_LIQUIDOS (IN p_fk_item_id integer)   BEGIN
    SELECT
        fecha,
        tipo_de_liquido,
        apariencia,
        color,
        hematocrito,
        creatinina,
        colesterol,
        trigliceridos,
        bilirrubina,
        proteinas,
        albumina,
        conteo_celular,
        viscocidad,
        prueba_de_mucina,
        prueba_de_pandy,
        descripcion_microscopica,
        globulinas,
        relacion_ag,
        interpretaciones,
        diagnostico,
        comentario,
        fk_item_id
    FROM
        liquidos
    WHERE
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE SELECT_PAGINED_BREEDS (IN p_breed VARCHAR(255), IN p_page_number INTEGER, IN p_breeds_per_page INTEGER)   BEGIN
    DECLARE p_offset INTEGER;
    SET p_offset = ((p_page_number - 1) * p_breeds_per_page);
    SELECT breed_id, breed FROM breeds WHERE breed LIKE CONCAT('%', p_breed, '%') ORDER BY breed ASC LIMIT p_breeds_per_page OFFSET p_offset;
END$$

CREATE PROCEDURE SELECT_PAGINED_CASES (IN p_case_number VARCHAR(255), IN p_page_number integer, IN p_cases_per_page integer)   BEGIN
    DECLARE p_offset INTEGER;
    SET p_offset = ((p_page_number - 1) * p_cases_per_page);
    SELECT 
        case_id, 
        case_number,
        opening_date,
        delivery_status,
        payment_status,
        CONCAT('$', SUM(payment), ' ', 'MXN') as total,
        IF(payment_percentage IS NULL, '', CONCAT(payment_percentage, '%')) AS payment_percentage
    FROM cases LEFT JOIN payments ON case_id = fk_case_id WHERE case_number LIKE CONCAT('%', p_case_number, '%') AND payment_status = 'PAGADO' AND delivery_status = 'ENTREGADO'
    GROUP BY 
    case_id, 
    case_number,
    opening_date,
    delivery_status,
    payment_status
    ORDER BY case_id DESC LIMIT p_cases_per_page OFFSET p_offset;
END$$

CREATE PROCEDURE SELECT_PAGINED_CLINICS (IN p_clinic VARCHAR(255), IN p_page_number INTEGER, IN p_clincs_per_page INTEGER)   BEGIN
    DECLARE p_offset INTEGER;
    SET p_offset = ((p_page_number - 1) * p_clincs_per_page);
    SELECT clinic_id, clinic FROM clinics WHERE clinic LIKE CONCAT('%', p_clinic, '%') ORDER BY clinic ASC LIMIT p_clincs_per_page OFFSET p_offset;
END$$

CREATE PROCEDURE SELECT_PAGINED_EXPENSES (IN p_description VARCHAR(255), IN p_page_number INTEGER, IN p_expenses_per_page INTEGER)   BEGIN
    DECLARE p_offset INTEGER;
    SET p_offset = ((p_page_number - 1) * p_expenses_per_page);
    SELECT 
        expense_id, 
        description, 
        CONCAT('$', amount, ' ', 'MXN') AS amount, 
        expense_date 
    FROM expenses WHERE description LIKE CONCAT('%', p_description, '%') ORDER BY expense_id DESC LIMIT p_expenses_per_page OFFSET p_offset;
END$$

CREATE PROCEDURE SELECT_PAGINED_PAYMENTS (IN p_case_number VARCHAR(255), IN p_page_number INTEGER, IN p_cases_per_page INTEGER)   BEGIN
    DECLARE p_offset INTEGER;
    SET p_offset = ((p_page_number - 1) * p_cases_per_page);
    SELECT 
        case_id,
        case_number, 
        CONCAT('$', payment, ' ', 'MXN') AS payment,
        payment_type,
        payment_date
    FROM cases INNER JOIN payments ON case_id = fk_case_id WHERE case_number LIKE CONCAT('%', p_case_number, '%')
    ORDER BY case_id DESC LIMIT p_cases_per_page OFFSET p_offset;
END$$

CREATE PROCEDURE SELECT_PAGINED_REFERENCIAS (IN p_specie VARCHAR(255), IN p_page_number INTEGER, IN p_referencias_per_page INTEGER)   BEGIN
    DECLARE p_offset INTEGER;
    SET p_offset = ((p_page_number - 1) * p_referencias_per_page);
    SELECT 
        referencia_id,
        specie,
        descripcion
    FROM species INNER JOIN referencias ON specie_id = fk_specie_id WHERE specie LIKE CONCAT('%', p_specie, '%') ORDER BY referencia_id DESC LIMIT p_referencias_per_page OFFSET p_offset;
END$$

CREATE PROCEDURE SELECT_PAGINED_SPECIES (IN p_specie VARCHAR(255), IN p_page_number INTEGER, IN p_species_per_page INTEGER)   BEGIN
    DECLARE p_offset INTEGER;
    SET p_offset = ((p_page_number - 1) * p_species_per_page);
    SELECT specie_id, specie FROM species WHERE specie LIKE CONCAT('%', p_specie, '%') ORDER BY specie ASC LIMIT p_species_per_page OFFSET p_offset;
END$$

CREATE PROCEDURE SELECT_PAGINED_STUDIES (IN p_study VARCHAR(255), IN p_page_number INTEGER, IN p_studies_per_page INTEGER)   BEGIN
    DECLARE p_offset INTEGER;
    SET p_offset = ((p_page_number - 1) * p_studies_per_page);
    SELECT 
        study_id, 
        study, 
        CONCAT('$', public_price, ' ', 'MXN') AS public_price, 
        CONCAT('$', vet_price, ' ', 'MXN') AS vet_price
        FROM studies WHERE study LIKE CONCAT('%', p_study, '%') ORDER BY study ASC LIMIT p_studies_per_page OFFSET p_offset;
END$$

CREATE PROCEDURE SELECT_PAGINED_USERS (IN p_username VARCHAR(255), IN p_page_number INTEGER, IN p_users_per_page INTEGER)   BEGIN
    DECLARE p_offset INTEGER;
    SET p_offset = ((p_page_number - 1) * p_users_per_page);
    SELECT user_id, username, first_name, last_name FROM users WHERE username LIKE CONCAT('%', p_username, '%') ORDER BY username ASC LIMIT p_users_per_page OFFSET p_offset;
END$$

CREATE PROCEDURE SELECT_PAYMENTS (IN p_fk_case_id INTEGER)   BEGIN
    SELECT payment_id, CONCAT('$', payment, ' ', 'MXN') AS payment, payment_type, payment_date FROM payments WHERE fk_case_id = p_fk_case_id;
END$$

CREATE PROCEDURE SELECT_PAYMENTS_SUMMARY (IN p_start_payment_date DATE, IN p_end_payment_date DATE)   BEGIN
SELECT COALESCE(SUM(payment), 0) AS payments_summary FROM payments WHERE DATE_SUB(payment_date, INTERVAL 6 HOUR) >= CONCAT(p_start_payment_date, ' 00:00:00') AND p_end_payment_date < CONCAT(p_end_payment_date, ' 23:59:59');
END$$

CREATE PROCEDURE SELECT_PRUEBAS (IN p_fk_item_id integer)   BEGIN
    SELECT 
        hematocrito,
        donador_1,
        hematocrito_donador_1,
        prueba_mayor_apariencia_donador_1,
        prueba_menor_apariencia_donador_1,
        prueba_mayor_agregados_celulares_donador_1,
        prueba_menor_agregados_celulares_donador_1,
        prueba_mayor_aglutinacion_donador_1,
        prueba_menor_aglutinacion_donador_1,
        observaciones_donador_1,
        donador_2,
        hematocrito_donador_2,
        prueba_mayor_apariencia_donador_2,
        prueba_menor_apariencia_donador_2,
        prueba_mayor_agregados_celulares_donador_2,
        prueba_menor_agregados_celulares_donador_2,
        prueba_mayor_aglutinacion_donador_2,
        prueba_menor_aglutinacion_donador_2,
        observaciones_donador_2,
        donador_3,
        hematocrito_donador_3,
        prueba_mayor_apariencia_donador_3,
        prueba_menor_apariencia_donador_3,
        prueba_mayor_agregados_celulares_donador_3,
        prueba_menor_agregados_celulares_donador_3,
        prueba_mayor_aglutinacion_donador_3,
        prueba_menor_aglutinacion_donador_3,
        observaciones_donador_3,
        donador_4,
        hematocrito_donador_4,
        prueba_mayor_apariencia_donador_4,
        prueba_menor_apariencia_donador_4,
        prueba_mayor_agregados_celulares_donador_4,
        prueba_menor_agregados_celulares_donador_4,
        prueba_mayor_aglutinacion_donador_4,
        prueba_menor_aglutinacion_donador_4,
        observaciones_donador_4,
        donador_5,
        hematocrito_donador_5,
        prueba_mayor_apariencia_donador_5,
        prueba_menor_apariencia_donador_5,
        prueba_mayor_agregados_celulares_donador_5,
        prueba_menor_agregados_celulares_donador_5,
        prueba_mayor_aglutinacion_donador_5,
        prueba_menor_aglutinacion_donador_5,
        observaciones_donador_5,
        interpretaciones,
        fk_item_id,
        fk_referencia_id
    FROM 
        pruebas
    WHERE 
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE SELECT_RASPADO (IN p_fk_item_id integer)   BEGIN
    SELECT
        fecha,
        resultado,
        fk_item_id
    FROM
        raspados
    WHERE
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE SELECT_REFERENCIA (IN p_referencia_id INTEGER)   BEGIN
    SELECT 
        referencia_id,
        descripcion, hematocrito, eritrocitos, hemoglobina, vgm, 
        cgmh, reticulocitos, plaquetas, solidos_totales, fibrinogeno, relacion_ptfib,
        leucocitos, neutrofilos, bandas, metamielocitos, mielocitos, 
        linfocitos, monocitos, eosinofilos, basofilos, glucosa,
        urea, creatinina, colesterol, trigliceridos, bilirrubina_total, 
        bilirrubina_conjugada, bilirrubina_no_conjugada, alanina_aminotransferasa, aspartato_aminotransferasa, fosfatasa_alcalina, 
        amilasa, lipasa, creatinacinasa, glutamato_deshidrogenasa, gamaglutamil_transferasa,
        proteinas_totales, albumina, globulinas, relacion_ag, calcio,
        fosforo, potasio, sodio, relacion_nak, cloro, bicarbonato, 
        brecha_anionica, diferencia_de_iones_fuertes, osmolalidad, amonio, tiempo_de_tromboplastina, tiempo_de_protrombina, t4_libre, fk_specie_id
    FROM referencias
    WHERE referencia_id = p_referencia_id;
END$$

CREATE PROCEDURE SELECT_REFERENCIAS (IN p_specie_id INTEGER)   BEGIN
    SELECT referencia_id, CONCAT(specie, ' - ', descripcion) AS descripcion FROM species INNER JOIN referencias ON specie_id = fk_specie_id WHERE specie_id = p_specie_id ORDER BY CONCAT(specie, ' - ', descripcion)ASC;
END$$

CREATE PROCEDURE SELECT_SESSION_USER (IN p_username VARCHAR(255))   BEGIN
    SELECT user_id, username, password, first_name, last_name FROM users WHERE username = p_username;
END$$

CREATE PROCEDURE SELECT_SPECIE (IN p_specie_id INTEGER)   BEGIN
    SELECT specie_id, specie FROM species WHERE specie_id = p_specie_id;
END$$

CREATE PROCEDURE SELECT_SPECIES ()   BEGIN
    SELECT specie_id, specie FROM species ORDER BY specie ASC;
END$$

CREATE PROCEDURE SELECT_STUDIES (IN p_fk_case_id integer)   BEGIN
    DECLARE p_price_type ENUM('NORMAL', 'ESPECIAL');
    SET p_price_type = (SELECT price_type FROM cases WHERE case_id = p_fk_case_id);

    SELECT 
        study_id, 
        study, 
        CASE 
            WHEN p_price_type = 'NORMAL' THEN 
                CASE 
                    WHEN public_price < 0 THEN CONCAT('-$', ABS(public_price), ' MXN') 
                    ELSE CONCAT('$', public_price, ' MXN') 
                END
            ELSE 
                CASE 
                    WHEN vet_price < 0 THEN CONCAT('-$', ABS(vet_price), ' MXN')
                    ELSE CONCAT('$', vet_price, ' MXN') 
                END
        END AS price        
    FROM studies 
    WHERE 
        study_id NOT IN (SELECT fk_study_id FROM items WHERE fk_case_id = p_fk_case_id)
    ORDER BY study ASC;
END$$

CREATE PROCEDURE SELECT_STUDY (IN p_study_id INTEGER)   BEGIN
    SELECT 
        study_id,
        study,
        public_price,
        vet_price,
        form
    FROM studies WHERE study_id = p_study_id;
END$$

CREATE PROCEDURE SELECT_TIEMPOS (IN p_fk_item_id integer)   BEGIN
    SELECT 
        fecha,
        tiempo_de_tromboplastina,
        tiempo_de_protrombina,
        interpretaciones,
        fk_item_id,
        fk_referencia_id
    FROM 
        tiempos
    WHERE 
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE SELECT_URIANALISIS (IN p_fk_item_id integer)   BEGIN
    SELECT
        fecha,
        metodo_de_obtencion,
        apariencia,
        color,
        densidad,
        ph,
        proteinas,
        glucosa,
        cetonas,
        bilirrubina,
        hemoglobina,
        eritrocitos,
        leucocitos,
        celulas_epiteliales_transitorias,
        celulas_epiteliales_escamosas,
        cilindros,
        tipo,
        cristales,
        bacterias,
        lipidos,
        otros,
        interpretaciones,
        fk_item_id
    FROM
        urianalisis
    WHERE
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE SELECT_USER (IN p_user_id INTEGER)   BEGIN
    SELECT user_id, username, first_name, last_name FROM users WHERE user_id = p_user_id;
END$$

CREATE PROCEDURE UPDATE_BIOQUIMICA (IN p_glucosa FLOAT, IN p_urea FLOAT, IN p_creatinina FLOAT, IN p_colesterol FLOAT, IN p_trigliceridos FLOAT, IN p_bilirrubina_total FLOAT, IN p_bilirrubina_conjugada FLOAT, IN p_alanina_aminotransferasa FLOAT, IN p_aspartato_aminotransferasa FLOAT, IN p_fosfatasa_alcalina FLOAT, IN p_amilasa FLOAT, IN p_lipasa FLOAT, IN p_creatinacinasa FLOAT, IN p_glutamato_deshidrogenasa FLOAT, IN p_gamaglutamil_transferasa FLOAT, IN p_proteinas_totales FLOAT, IN p_albumina FLOAT, IN p_calcio FLOAT, IN p_fosforo FLOAT, IN p_potasio FLOAT, IN p_sodio FLOAT, IN p_cloro FLOAT, IN p_bicarbonato FLOAT, IN p_amonio FLOAT, IN p_observaciones TEXT, IN p_interpretaciones TEXT, IN p_fk_referencia_id integer, IN p_fk_item_id integer, IN p_fecha DATE)   BEGIN
    UPDATE bioquimicas SET
        albumina_minima_normal = (SELECT CONVERT(SUBSTRING_INDEX(albumina, "-", 1), FLOAT) FROM referencias WHERE referencia_id = p_fk_referencia_id),
        calcio_minimo_normal = (SELECT CONVERT(SUBSTRING_INDEX(calcio, "-", 1), FLOAT) FROM referencias WHERE referencia_id = p_fk_referencia_id),
        calcio_maximo_normal = (SELECT CONVERT(SUBSTRING_INDEX(calcio, "-", -1), FLOAT) FROM referencias WHERE referencia_id = p_fk_referencia_id)
    WHERE 
        fk_item_id = p_fk_item_id;    

    UPDATE bioquimicas SET
        fecha = p_fecha,
        glucosa = p_glucosa,
        urea = p_urea,
        creatinina = p_creatinina,
        colesterol = p_colesterol,
        trigliceridos = p_trigliceridos,
        bilirrubina_total = p_bilirrubina_total,
        bilirrubina_conjugada = p_bilirrubina_conjugada,
        alanina_aminotransferasa = p_alanina_aminotransferasa,
        aspartato_aminotransferasa = p_aspartato_aminotransferasa,
        fosfatasa_alcalina = p_fosfatasa_alcalina,
        amilasa = p_amilasa,
        lipasa = p_lipasa,
        creatinacinasa = p_creatinacinasa,
        glutamato_deshidrogenasa = p_glutamato_deshidrogenasa,
        gamaglutamil_transferasa = p_gamaglutamil_transferasa,
        proteinas_totales = p_proteinas_totales,
        albumina = p_albumina,
        calcio = p_calcio,
        fosforo = p_fosforo,
        potasio = p_potasio,
        sodio = p_sodio,
        cloro = p_cloro,
        bicarbonato = p_bicarbonato,
        amonio = p_amonio,
        interpretaciones = p_interpretaciones,
        observaciones = p_observaciones,
        fk_referencia_id = p_fk_referencia_id
    WHERE 
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE UPDATE_BREED (IN p_breed_id INTEGER, IN p_breed VARCHAR(255), IN p_fk_specie_id INTEGER)   BEGIN
    UPDATE breeds SET breed = UPPER(p_breed), fk_specie_id = p_fk_specie_id WHERE breed_id = p_breed_id;
END$$

CREATE PROCEDURE UPDATE_CASE (IN p_case_id INTEGER, IN p_pet VARCHAR(255), IN p_sex ENUM('SIN ESPECIFICAR','MACHO','MACHO ESTERILIZADO','HEMBRA','HEMBRA ESTERILIZADO'), IN p_age VARCHAR(25), IN p_body_condition_score ENUM('1/5','2/5','3/5','4/5','5/5'), IN p_anamnesis VARCHAR(500), IN p_treatment VARCHAR(500), IN p_price_type ENUM('NORMAL','ESPECIAL'), IN p_invoice ENUM('SÍ','NO'), IN p_delivery_status ENUM('ENTREGADO','NO ENTREGADO'), IN p_fk_breed_id INTEGER, IN p_fk_clinic_id INTEGER, IN p_fk_user_id INTEGER)   BEGIN
    UPDATE cases SET
        pet = UPPER(p_pet),
        sex = UPPER(p_sex),
        age = UPPER(p_age),
        body_condition_score = p_body_condition_score,
        anamnesis = p_anamnesis,
        treatment = p_treatment,
        price_type = p_price_type,
        invoice = p_invoice,
        delivery_status = p_delivery_status,
        fk_breed_id = p_fk_breed_id,
        fk_clinic_id = p_fk_clinic_id,
        fk_user_id = p_fk_user_id
    WHERE case_id = p_case_id;
    IF p_price_type = 'NORMAL' THEN
        UPDATE items SET price = (SELECT public_price FROM studies WHERE study_id = fk_study_id) WHERE fk_case_id = p_case_id;
    ELSE
        UPDATE items SET price = (SELECT vet_price FROM studies WHERE study_id = fk_study_id) WHERE fk_case_id = p_case_id;
    END IF;
END$$

CREATE PROCEDURE UPDATE_CITOLOGIA (IN p_descripcion_macroscopica_de_la_lesion TEXT, IN p_descripcion_citologica TEXT, IN p_interpretaciones TEXT, IN p_diagnostico TEXT, IN p_comentario TEXT, IN p_fk_item_id integer, IN p_fecha DATE)   BEGIN
    UPDATE citologias
    SET
        descripcion_macroscopica_de_la_lesion = p_descripcion_macroscopica_de_la_lesion,
        descripcion_citologica = p_descripcion_citologica,
        interpretaciones = p_interpretaciones,
        diagnostico = p_diagnostico,
        comentario = p_comentario,
        fecha = p_fecha
    WHERE
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE UPDATE_CLINIC (IN p_clinic_id INTEGER, IN p_clinic VARCHAR(255), IN p_address VARCHAR(255), IN p_vet VARCHAR(255), IN p_email VARCHAR(255), IN p_phone_number VARCHAR(25))   BEGIN
    UPDATE clinics SET clinic = UPPER(p_clinic), address = UPPER(p_address), vet = UPPER(p_vet), email = LOWER(p_email), phone_number = UPPER(p_phone_number) WHERE clinic_id = p_clinic_id;
END$$

CREATE PROCEDURE UPDATE_COPROPARASITOSCOPICO (IN p_prueba TEXT, IN p_resultado_1 TEXT, IN p_resultado_2 TEXT, IN p_resultado_3 TEXT, IN p_fecha_1 DATE, IN p_fecha_2 DATE, IN p_fecha_3 DATE, IN p_fk_item_id INTEGER)   BEGIN
    UPDATE coproparasitocopicos
    SET 
        prueba = p_prueba,
        resultado_1 = p_resultado_1,
        resultado_2 = p_resultado_2,
        resultado_3 = p_resultado_3,
        fecha_1 = p_fecha_1,
        fecha_2 = p_fecha_2,
        fecha_3 = p_fecha_3
    WHERE 
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE UPDATE_ELISA (IN p_observaciones TEXT, IN p_ac_anaplasma ENUM('POSITIVO','NEGATIVO'), IN p_ac_borrelia_burgdorferi ENUM('POSITIVO','NEGATIVO'), IN p_ac_ehrlichia_canis ENUM('POSITIVO','NEGATIVO'), IN p_ac_vif ENUM('POSITIVO','NEGATIVO'), IN p_ag_dirofilaria_immitis ENUM('POSITIVO','NEGATIVO'), IN p_ag_filaria ENUM('POSITIVO','NEGATIVO'), IN p_ag_distemper_canino ENUM('POSITIVO','NEGATIVO'), IN p_ag_levf ENUM('POSITIVO','NEGATIVO'), IN p_ag_parvovirus ENUM('POSITIVO','NEGATIVO'), IN p_fk_item_id integer, IN p_fecha DATE)   BEGIN
    UPDATE elisas
    SET 
        fecha = p_fecha,
        observaciones = p_observaciones,
        ac_anaplasma = p_ac_anaplasma,
        ac_borrelia_burgdorferi = p_ac_borrelia_burgdorferi,
        ac_ehrlichia_canis = p_ac_ehrlichia_canis,
        ac_vif = p_ac_vif,
        ag_dirofilaria_immitis = p_ag_dirofilaria_immitis,
        ag_filaria = p_ag_filaria,
        ag_distemper_canino = p_ag_distemper_canino,
        ag_levf = p_ag_levf,
        ag_parvovirus = p_ag_parvovirus
    WHERE 
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE UPDATE_EXPENSE (IN p_expense_id INTEGER, IN p_description VARCHAR(255), IN p_amount DECIMAL(10,2))   BEGIN
    UPDATE expenses SET 
        description = UPPER(p_description), 
        amount = p_amount 
    WHERE expense_id = p_expense_id;
END$$

CREATE PROCEDURE UPDATE_HEMOGRAMA (IN p_hematocrito FLOAT, IN p_eritrocitos FLOAT, IN p_hemoglobina FLOAT, IN p_reticulocitos FLOAT, IN p_reticulocito_1 FLOAT, IN p_reticulocito_2 FLOAT, IN p_reticulocito_3 FLOAT, IN p_reticulocito_4 FLOAT, IN p_reticulocito_5 FLOAT, IN p_reticulocito_6 FLOAT, IN p_reticulocito_7 FLOAT, IN p_reticulocito_8 FLOAT, IN p_reticulocito_9 FLOAT, IN p_reticulocito_10 FLOAT, IN p_plaqueta_1 FLOAT, IN p_plaqueta_2 FLOAT, IN p_plaqueta_3 FLOAT, IN p_plaqueta_4 FLOAT, IN p_plaqueta_5 FLOAT, IN p_solidos_totales FLOAT, IN p_proteina_1 FLOAT, IN p_proteina_2 FLOAT, IN p_leucocitos FLOAT, IN p_neutrofilos FLOAT, IN p_bandas FLOAT, IN p_metamielocitos FLOAT, IN p_mielocitos FLOAT, IN p_linfocitos FLOAT, IN p_monocitos FLOAT, IN p_eosinofilos FLOAT, IN p_basofilos FLOAT, IN p_anisocitosis VARCHAR(255), IN p_policromasia VARCHAR(255), IN p_aglutinacion VARCHAR(255), IN p_poiquilocitos VARCHAR(255), IN p_neutrofilos_toxicos VARCHAR(255), IN p_linfocitos_reactivos VARCHAR(255), IN p_otros_hallazgos VARCHAR(255), IN p_eritrocitos_nucleados FLOAT, IN p_observaciones TEXT, IN p_interpretaciones TEXT, IN p_fk_referencia_id integer, IN p_fk_item_id integer, IN p_fecha DATE)   BEGIN
   UPDATE hemogramas
    SET
        fecha = p_fecha,
        hematocrito = p_hematocrito,
        eritrocitos = p_eritrocitos,
        hemoglobina = p_hemoglobina,
        reticulocitos = p_reticulocitos,
        reticulocito_1 = p_reticulocito_1,
        reticulocito_2 = p_reticulocito_2,
        reticulocito_3 = p_reticulocito_3,
        reticulocito_4 = p_reticulocito_4,
        reticulocito_5 = p_reticulocito_5,
        reticulocito_6 = p_reticulocito_6,
        reticulocito_7 = p_reticulocito_7,
        reticulocito_8 = p_reticulocito_8,
        reticulocito_9 = p_reticulocito_9,
        reticulocito_10 = p_reticulocito_10,
        plaqueta_1 = p_plaqueta_1,
        plaqueta_2 = p_plaqueta_2,
        plaqueta_3 = p_plaqueta_3,
        plaqueta_4 = p_plaqueta_4,
        plaqueta_5 = p_plaqueta_5,
        solidos_totales = p_solidos_totales,
        proteina_1 = p_proteina_1,
        proteina_2 = p_proteina_2,
        leucocitos = p_leucocitos,
        neutrofilos = p_neutrofilos,
        bandas = p_bandas,
        metamielocitos = p_metamielocitos,
        mielocitos = p_mielocitos,
        linfocitos = p_linfocitos,
        monocitos = p_monocitos,
        eosinofilos = p_eosinofilos,
        basofilos = p_basofilos,
        anisocitosis = p_anisocitosis,
        policromasia = p_policromasia,
        aglutinacion = p_aglutinacion,
        poiquilocitos = p_poiquilocitos,
        neutrofilos_toxicos = p_neutrofilos_toxicos,
        linfocitos_reactivos = p_linfocitos_reactivos,
        otros_hallazgos = p_otros_hallazgos,
        eritrocitos_nucleados = p_eritrocitos_nucleados,
        interpretaciones = p_interpretaciones,
        observaciones = p_observaciones,
        fk_referencia_id = p_fk_referencia_id
    WHERE 
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE UPDATE_K (IN p_colesterol FLOAT, IN p_t4_libre FLOAT, IN p_diagnostico TEXT, IN p_valores_de_referencia TEXT, IN p_fk_referencia_id integer, IN p_fk_item_id integer, IN p_fecha DATE)   BEGIN
    UPDATE k
    SET
        fecha = p_fecha,
        colesterol = p_colesterol,
        t4_libre = p_t4_libre,
        diagnostico = p_diagnostico,
        valores_de_referencia = p_valores_de_referencia,
        fk_referencia_id = p_fk_referencia_id
    WHERE 
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE UPDATE_LIQUIDOS (IN p_tipo_de_liquido VARCHAR(255), IN p_apariencia VARCHAR(255), IN p_color VARCHAR(255), IN p_hematocrito VARCHAR(255), IN p_creatinina VARCHAR(255), IN p_colesterol VARCHAR(255), IN p_trigliceridos VARCHAR(255), IN p_bilirrubina VARCHAR(255), IN p_proteinas VARCHAR(255), IN p_albumina VARCHAR(255), IN p_conteo_celular VARCHAR(255), IN p_viscocidad VARCHAR(255), IN p_prueba_de_mucina VARCHAR(255), IN p_prueba_de_pandy VARCHAR(255), IN p_descripcion_microscopica TEXT, IN p_globulinas TEXT, IN p_relacion_ag TEXT, IN p_interpretaciones TEXT, IN p_diagnostico TEXT, IN p_comentario TEXT, IN p_fk_item_id integer, IN p_fecha DATE)   BEGIN
    UPDATE liquidos
    SET
        fecha = p_fecha,
        tipo_de_liquido = p_tipo_de_liquido,
        apariencia = p_apariencia,
        color = p_color,
        hematocrito = p_hematocrito,
        creatinina = p_creatinina,
        colesterol = p_colesterol,
        trigliceridos = p_trigliceridos,
        bilirrubina = p_bilirrubina,
        proteinas = p_proteinas,
        albumina = p_albumina,
        conteo_celular = p_conteo_celular,
        viscocidad = p_viscocidad,
        prueba_de_mucina = p_prueba_de_mucina,
        prueba_de_pandy = p_prueba_de_pandy,
        descripcion_microscopica = p_descripcion_microscopica,
        globulinas = p_globulinas,
        relacion_ag = p_relacion_ag,
        interpretaciones = p_interpretaciones,
        diagnostico = p_diagnostico,
        comentario = p_comentario
    WHERE
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE UPDATE_PRUEBAS (IN p_hematocrito FLOAT, IN p_donador_1 VARCHAR(255), IN p_hematocrito_donador_1 VARCHAR(255), IN p_prueba_mayor_apariencia_donador_1 VARCHAR(255), IN p_prueba_menor_apariencia_donador_1 VARCHAR(255), IN p_prueba_mayor_agregados_celulares_donador_1 VARCHAR(255), IN p_prueba_menor_agregados_celulares_donador_1 VARCHAR(255), IN p_prueba_mayor_aglutinacion_donador_1 VARCHAR(255), IN p_prueba_menor_aglutinacion_donador_1 VARCHAR(255), IN p_observaciones_donador_1 TEXT, IN p_donador_2 VARCHAR(255), IN p_hematocrito_donador_2 VARCHAR(255), IN p_prueba_mayor_apariencia_donador_2 VARCHAR(255), IN p_prueba_menor_apariencia_donador_2 VARCHAR(255), IN p_prueba_mayor_agregados_celulares_donador_2 VARCHAR(255), IN p_prueba_menor_agregados_celulares_donador_2 VARCHAR(255), IN p_prueba_mayor_aglutinacion_donador_2 VARCHAR(255), IN p_prueba_menor_aglutinacion_donador_2 VARCHAR(255), IN p_observaciones_donador_2 TEXT, IN p_donador_3 VARCHAR(255), IN p_hematocrito_donador_3 VARCHAR(255), IN p_prueba_mayor_apariencia_donador_3 VARCHAR(255), IN p_prueba_menor_apariencia_donador_3 VARCHAR(255), IN p_prueba_mayor_agregados_celulares_donador_3 VARCHAR(255), IN p_prueba_menor_agregados_celulares_donador_3 VARCHAR(255), IN p_prueba_mayor_aglutinacion_donador_3 VARCHAR(255), IN p_prueba_menor_aglutinacion_donador_3 VARCHAR(255), IN p_observaciones_donador_3 TEXT, IN p_donador_4 VARCHAR(255), IN p_hematocrito_donador_4 VARCHAR(255), IN p_prueba_mayor_apariencia_donador_4 VARCHAR(255), IN p_prueba_menor_apariencia_donador_4 VARCHAR(255), IN p_prueba_mayor_agregados_celulares_donador_4 VARCHAR(255), IN p_prueba_menor_agregados_celulares_donador_4 VARCHAR(255), IN p_prueba_mayor_aglutinacion_donador_4 VARCHAR(255), IN p_prueba_menor_aglutinacion_donador_4 VARCHAR(255), IN p_observaciones_donador_4 TEXT, IN p_donador_5 VARCHAR(255), IN p_hematocrito_donador_5 VARCHAR(255), IN p_prueba_mayor_apariencia_donador_5 VARCHAR(255), IN p_prueba_menor_apariencia_donador_5 VARCHAR(255), IN p_prueba_mayor_agregados_celulares_donador_5 VARCHAR(255), IN p_prueba_menor_agregados_celulares_donador_5 VARCHAR(255), IN p_prueba_mayor_aglutinacion_donador_5 VARCHAR(255), IN p_prueba_menor_aglutinacion_donador_5 VARCHAR(255), IN p_observaciones_donador_5 TEXT, IN p_interpretaciones TEXT, IN p_fk_item_id INTEGER, IN p_fk_referencia_id INTEGER)   BEGIN
    UPDATE pruebas
    SET 
        hematocrito = p_hematocrito,
        donador_1 = UPPER(p_donador_1),
        donador_2 = UPPER(p_donador_2),
        donador_3 = UPPER(p_donador_3),
        donador_4 = UPPER(p_donador_4),
        donador_5 = UPPER(p_donador_5),
        hematocrito_donador_1 = p_hematocrito_donador_1,
        hematocrito_donador_2 = p_hematocrito_donador_2,
        hematocrito_donador_3 = p_hematocrito_donador_3,
        hematocrito_donador_4 = p_hematocrito_donador_4,
        hematocrito_donador_5 = p_hematocrito_donador_5,
        prueba_mayor_apariencia_donador_1 = p_prueba_mayor_apariencia_donador_1,
        prueba_mayor_apariencia_donador_2 = p_prueba_mayor_apariencia_donador_2,
        prueba_mayor_apariencia_donador_3 = p_prueba_mayor_apariencia_donador_3,
        prueba_mayor_apariencia_donador_4 = p_prueba_mayor_apariencia_donador_4,
        prueba_mayor_apariencia_donador_5 = p_prueba_mayor_apariencia_donador_5,
        prueba_menor_apariencia_donador_1 = p_prueba_menor_apariencia_donador_1,
        prueba_menor_apariencia_donador_2 = p_prueba_menor_apariencia_donador_2,
        prueba_menor_apariencia_donador_3 = p_prueba_menor_apariencia_donador_3,
        prueba_menor_apariencia_donador_4 = p_prueba_menor_apariencia_donador_4,
        prueba_menor_apariencia_donador_5 = p_prueba_menor_apariencia_donador_5,
        prueba_mayor_agregados_celulares_donador_1 = p_prueba_mayor_agregados_celulares_donador_1,
        prueba_mayor_agregados_celulares_donador_2 = p_prueba_mayor_agregados_celulares_donador_2,
        prueba_mayor_agregados_celulares_donador_3 = p_prueba_mayor_agregados_celulares_donador_3,
        prueba_mayor_agregados_celulares_donador_4 = p_prueba_mayor_agregados_celulares_donador_4,
        prueba_mayor_agregados_celulares_donador_5 = p_prueba_mayor_agregados_celulares_donador_5,
        prueba_menor_agregados_celulares_donador_1 = p_prueba_menor_agregados_celulares_donador_1,
        prueba_menor_agregados_celulares_donador_2 = p_prueba_menor_agregados_celulares_donador_2,
        prueba_menor_agregados_celulares_donador_3 = p_prueba_menor_agregados_celulares_donador_3,
        prueba_menor_agregados_celulares_donador_4 = p_prueba_menor_agregados_celulares_donador_4,
        prueba_menor_agregados_celulares_donador_5 = p_prueba_menor_agregados_celulares_donador_5,
        prueba_mayor_aglutinacion_donador_1 = p_prueba_mayor_aglutinacion_donador_1,
        prueba_mayor_aglutinacion_donador_2 = p_prueba_mayor_aglutinacion_donador_2,
        prueba_mayor_aglutinacion_donador_3 = p_prueba_mayor_aglutinacion_donador_3,
        prueba_mayor_aglutinacion_donador_4 = p_prueba_mayor_aglutinacion_donador_4,
        prueba_mayor_aglutinacion_donador_5 = p_prueba_mayor_aglutinacion_donador_5,
        prueba_menor_aglutinacion_donador_1 = p_prueba_menor_aglutinacion_donador_1,
        prueba_menor_aglutinacion_donador_2 = p_prueba_menor_aglutinacion_donador_2,
        prueba_menor_aglutinacion_donador_3 = p_prueba_menor_aglutinacion_donador_3,
        prueba_menor_aglutinacion_donador_4 = p_prueba_menor_aglutinacion_donador_4,
        prueba_menor_aglutinacion_donador_5 = p_prueba_menor_aglutinacion_donador_5,
        observaciones_donador_1 = p_observaciones_donador_1,
        observaciones_donador_2 = p_observaciones_donador_2,
        observaciones_donador_3 = p_observaciones_donador_3,
        observaciones_donador_4 = p_observaciones_donador_4,
        observaciones_donador_5 = p_observaciones_donador_5,
        interpretaciones = p_interpretaciones,
        fk_referencia_id = p_fk_referencia_id
    WHERE 
       fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE UPDATE_RASPADO (IN p_resultado TEXT, IN p_fk_item_id integer, IN p_fecha DATE)   BEGIN
    UPDATE raspados
    SET 
        fecha = p_fecha,
        resultado = p_resultado
    WHERE 
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE UPDATE_REFERENCIA (IN p_referencia_id INTEGER, IN p_descripcion VARCHAR(100), IN p_hematocrito VARCHAR(20), IN p_eritrocitos VARCHAR(20), IN p_hemoglobina VARCHAR(20), IN p_vgm VARCHAR(20), IN p_cgmh VARCHAR(20), IN p_reticulocitos VARCHAR(20), IN p_plaquetas VARCHAR(20), IN p_solidos_totales VARCHAR(20), IN p_fibrinogeno VARCHAR(20), IN p_relacion_ptfib VARCHAR(20), IN p_leucocitos VARCHAR(20), IN p_neutrofilos VARCHAR(20), IN p_bandas VARCHAR(20), IN p_metamielocitos VARCHAR(20), IN p_mielocitos VARCHAR(20), IN p_linfocitos VARCHAR(20), IN p_monocitos VARCHAR(20), IN p_eosinofilos VARCHAR(20), IN p_basofilos VARCHAR(20), IN p_glucosa VARCHAR(20), IN p_urea VARCHAR(20), IN p_creatinina VARCHAR(20), IN p_colesterol VARCHAR(20), IN p_trigliceridos VARCHAR(20), IN p_bilirrubina_total VARCHAR(20), IN p_bilirrubina_conjugada VARCHAR(20), IN p_bilirrubina_no_conjugada VARCHAR(20), IN p_alanina_aminotransferasa VARCHAR(20), IN p_aspartato_aminotransferasa VARCHAR(20), IN p_fosfatasa_alcalina VARCHAR(20), IN p_amilasa VARCHAR(20), IN p_lipasa VARCHAR(20), IN p_creatinacinasa VARCHAR(20), IN p_glutamato_deshidrogenasa VARCHAR(20), IN p_gamaglutamil_transferasa VARCHAR(20), IN p_proteinas_totales VARCHAR(20), IN p_albumina VARCHAR(20), IN p_globulinas VARCHAR(20), IN p_relacion_ag VARCHAR(20), IN p_calcio VARCHAR(20), IN p_fosforo VARCHAR(20), IN p_potasio VARCHAR(20), IN p_sodio VARCHAR(20), IN p_relacion_nak VARCHAR(20), IN p_cloro VARCHAR(20), IN p_bicarbonato VARCHAR(20), IN p_brecha_anionica VARCHAR(20), IN p_diferencia_de_iones_fuertes VARCHAR(20), IN p_osmolalidad VARCHAR(20), IN p_amonio VARCHAR(20), IN p_tiempo_de_tromboplastina VARCHAR(20), IN p_tiempo_de_protrombina VARCHAR(20), IN p_t4_libre VARCHAR(20), IN p_fk_specie_id INTEGER)   BEGIN
    UPDATE referencias
    SET
        descripcion = UPPER(p_descripcion),
        hematocrito = p_hematocrito,
        eritrocitos = p_eritrocitos,
        hemoglobina = p_hemoglobina,
        vgm = p_vgm,
        cgmh = p_cgmh,
        reticulocitos = p_reticulocitos,
        plaquetas = p_plaquetas,
        solidos_totales = p_solidos_totales,
        fibrinogeno = p_fibrinogeno,
        relacion_ptfib = p_relacion_ptfib,
        leucocitos = p_leucocitos,
        neutrofilos = p_neutrofilos,
        bandas = p_bandas,
        metamielocitos = p_metamielocitos,
        mielocitos = p_mielocitos,
        linfocitos = p_linfocitos,
        monocitos = p_monocitos,
        eosinofilos = p_eosinofilos,
        basofilos = p_basofilos,
        glucosa = p_glucosa,
        urea = p_urea,
        creatinina = p_creatinina,
        colesterol = p_colesterol,
        trigliceridos = p_trigliceridos,
        bilirrubina_total = p_bilirrubina_total,
        bilirrubina_conjugada = p_bilirrubina_conjugada,
        bilirrubina_no_conjugada = p_bilirrubina_no_conjugada,
        alanina_aminotransferasa = p_alanina_aminotransferasa,
        aspartato_aminotransferasa = p_aspartato_aminotransferasa,
        fosfatasa_alcalina = p_fosfatasa_alcalina,
        amilasa = p_amilasa,
        lipasa = p_lipasa,
        creatinacinasa = p_creatinacinasa,
        glutamato_deshidrogenasa = p_glutamato_deshidrogenasa,
        gamaglutamil_transferasa = p_gamaglutamil_transferasa,
        proteinas_totales = p_proteinas_totales,
        albumina = p_albumina,
        globulinas = p_globulinas,
        relacion_ag = p_relacion_ag,
        calcio = p_calcio,
        fosforo = p_fosforo,
        potasio = p_potasio,
        sodio = p_sodio,
        relacion_nak = p_relacion_nak,
        cloro = p_cloro,
        bicarbonato = p_bicarbonato,
        brecha_anionica = p_brecha_anionica,
        diferencia_de_iones_fuertes = p_diferencia_de_iones_fuertes,
        osmolalidad = p_osmolalidad,
        amonio = p_amonio,
        tiempo_de_tromboplastina = p_tiempo_de_tromboplastina,
        tiempo_de_protrombina = p_tiempo_de_protrombina,
        t4_libre = p_t4_libre,
        fk_specie_id = p_fk_specie_id
    WHERE referencia_id = p_referencia_id;
END$$

CREATE PROCEDURE UPDATE_SPECIE (IN p_specie_id INTEGER, IN p_specie VARCHAR(255))   BEGIN
    UPDATE species SET specie = UPPER(p_specie) WHERE specie_id = p_specie_id;
END$$

CREATE PROCEDURE UPDATE_STUDY (IN p_study_id INTEGER, IN p_study VARCHAR(255), IN p_public_price DECIMAL(10,2), IN p_vet_price DECIMAL(10,2))   BEGIN
    UPDATE studies SET study = UPPER(p_study), public_price = p_public_price, vet_price = p_vet_price WHERE study_id = p_study_id;
END$$

CREATE PROCEDURE UPDATE_TIEMPOS (IN p_tiempo_de_tromboplastina VARCHAR(255), IN p_tiempo_de_protrombina VARCHAR(255), IN p_interpretaciones TEXT, IN p_fk_referencia_id integer, IN p_fk_item_id integer, IN p_fecha DATE)   BEGIN
    UPDATE tiempos
    SET 
        fecha = p_fecha,
        tiempo_de_tromboplastina = p_tiempo_de_tromboplastina,
        tiempo_de_protrombina = p_tiempo_de_protrombina,
        interpretaciones = p_interpretaciones,
        fk_referencia_id = p_fk_referencia_id
    WHERE 
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE UPDATE_URIANALISIS (IN p_metodo_de_obtencion ENUM('MICCIÓN','CATETERISMO','CISTOCENTESIS'), IN p_apariencia VARCHAR(255), IN p_color VARCHAR(255), IN p_densidad VARCHAR(255), IN p_ph VARCHAR(255), IN p_proteinas VARCHAR(255), IN p_glucosa VARCHAR(255), IN p_cetonas VARCHAR(255), IN p_bilirrubina VARCHAR(255), IN p_hemoglobina VARCHAR(255), IN p_eritrocitos VARCHAR(255), IN p_leucocitos VARCHAR(255), IN p_celulas_epiteliales_transitorias VARCHAR(255), IN p_celulas_epiteliales_escamosas VARCHAR(255), IN p_cilindros VARCHAR(255), IN p_tipo VARCHAR(255), IN p_cristales VARCHAR(255), IN p_bacterias VARCHAR(255), IN p_lipidos VARCHAR(255), IN p_otros VARCHAR(255), IN p_interpretaciones TEXT, IN p_fk_item_id integer, IN p_fecha DATE)   BEGIN
    UPDATE urianalisis
    SET 
        fecha = p_fecha,
        metodo_de_obtencion = p_metodo_de_obtencion,
        apariencia = p_apariencia,
        color = p_color,
        densidad = p_densidad,
        ph = p_ph,
        proteinas = p_proteinas,
        glucosa = p_glucosa,
        cetonas = p_cetonas,
        bilirrubina = p_bilirrubina,
        hemoglobina = p_hemoglobina,
        eritrocitos = p_eritrocitos,
        leucocitos = p_leucocitos,
        celulas_epiteliales_transitorias = p_celulas_epiteliales_transitorias,
        celulas_epiteliales_escamosas = p_celulas_epiteliales_escamosas,
        cilindros = p_cilindros,
        tipo = p_tipo,
        cristales = p_cristales,
        bacterias = p_bacterias,
        lipidos = p_lipidos,
        otros = p_otros,
        interpretaciones = p_interpretaciones
    WHERE 
        fk_item_id = p_fk_item_id;
END$$

CREATE PROCEDURE UPDATE_USER (IN p_user_id INTEGER, IN p_username VARCHAR(255), IN p_password VARCHAR(255), IN p_first_name VARCHAR(255), IN p_last_name VARCHAR(255))   BEGIN
    UPDATE users SET username = LOWER(p_username), first_name = UPPER(p_first_name), last_name = UPPER(p_last_name) WHERE user_id = p_user_id;
    IF p_password IS NOT NULL THEN
        UPDATE users SET password = p_password WHERE user_id = p_user_id;
    END IF;
END$$

DELIMITER ;

INSERT INTO users VALUES (1, 'root', '$2y$12$KyM6RpNkNf1yRCArvWWqgOxYFdRSlPxv.lwzK35Mp.Uud8YdL1h7G', 'JOSÉ MANUEL', 'RIVERA GONZÁLEZ');

INSERT INTO clinics (clinic_id, clinic, address, vet, email, phone_number) VALUES
(1, 'VETERINARIA CÓDIGO CANINO', 'CALLE DE LA LÓGICA #10, COL. PROGRAMACIÓN', 'NORMAN PHP PÉREZ', 'oswaldo.php@example.com', '000-111-0101');

INSERT INTO species (specie_id, specie) VALUES
(1, 'PERRO');

INSERT INTO breeds (breed_id, breed, fk_specie_id) VALUES
(1, 'CHIHUAHUA', 1);

INSERT INTO studies (study_id, study, public_price, vet_price, form) VALUES
(1, 'URGENTE', '100.00', '100.00', 'NO'),
(2, 'BIOQUÍMICA COMPLETA', '630.00', '600.00', 'BIOQUÍMICA'),
(3, 'BIOQUÍMICA BÁSICA', '370.00', '350.00', 'BIOQUÍMICA'),
(4, 'BIOQUÍMICA SIMPLE', '220.00', '200.00', 'BIOQUÍMICA'),
(5, 'PERFIL BÁSICO', '550.00', '550.00', 'BIOQUÍMICA'),
(6, 'PERFIL HEPÁTICO', '530.00', '500.00', 'BIOQUÍMICA'),
(7, 'PERFIL RENAL', '320.00', '300.00', 'BIOQUÍMICA'),
(8, 'ANALITO (UREA)', '98.00', '98.00', 'BIOQUÍMICA'),
(9, 'ANALITO (GLUCOSA)', '95.00', '95.00', 'BIOQUÍMICA'),
(10, 'ANALITO (COLESTEROL)', '95.00', '95.00', 'BIOQUÍMICA'),
(11, 'ANALITO (TRIGLICÉRIDOS)', '99.00', '99.00', 'BIOQUÍMICA'),
(12, 'ANALITO (CREATININA)', '95.00', '95.00', 'BIOQUÍMICA'),
(13, 'ANALITO (AST)', '68.00', '68.00', 'BIOQUÍMICA'),
(14, 'ANALITO (ALT)', '68.00', '68.00', 'BIOQUÍMICA'),
(15, 'ANALITO (AMILASA)', '88.00', '88.00', 'BIOQUÍMICA'),
(16, 'ANALITO (FA)', '69.00', '69.00', 'BIOQUÍMICA'),
(17, 'ANALITO (CK)', '90.00', '90.00', 'BIOQUÍMICA'),
(18, 'ANALITO (BD)', '68.00', '68.00', 'BIOQUÍMICA'),
(19, 'ANALITO (BT)', '69.00', '69.00', 'BIOQUÍMICA'),
(20, 'ANALITO (FÓSFORO)', '95.00', '95.00', 'BIOQUÍMICA'),
(21, 'ANALITO (PT)', '94.00', '94.00', 'BIOQUÍMICA'),
(22, 'ANALITO (CALCIO)', '95.00', '95.00', 'BIOQUÍMICA'),
(23, 'ANALITO (ALBÚMINA)', '95.00', '95.00', 'BIOQUÍMICA'),
(24, 'ANALITO (GGT)', '100.00', '100.00', 'BIOQUÍMICA'),
(25, 'ANALITO (LIPASA)', '100.00', '100.00', 'BIOQUÍMICA'),
(26, 'ANALITO (AMONIO)', '220.00', '220.00', 'BIOQUÍMICA'),
(27, 'HEMOGRAMA', '160.00', '160.00', 'HEMOGRAMA'),
(28, 'TIEMPOS DE COAGULACIÓN', '185.00', '185.00', 'TIEMPOS DE COAGULACIÓN'),
(29, 'CITOLOGÍA VAGINAL', '220.00', '200.00', 'CITOLOGÍA'),
(30, 'CITOLOGÍA CLÍNICA (1 A 3 LAMINILLAS)', '150.00', '150.00', 'CITOLOGÍA'),
(31, 'CITOLOGÍA CLÍNICA (4 A 6 LAMINILLAS)', '200.00', '200.00', 'CITOLOGÍA'),
(32, 'ANÁLISIS DE LÍQUIDOS', '170.00', '150.00', 'ANÁLISIS DE LÍQUIDOS'),
(33, 'COPROPARASITOSCÓPICO (1 MUESTRA)', '80.00', '80.00', 'COPROPARASITOSCÓPICO'),
(34, 'COPROPARASITOSCÓPICO (SERIADO)', '240.00', '240.00', 'COPROPARASITOSCÓPICO'),
(35, 'RASPADO CUTÁNEO', '80.00', '70.00', 'RASPADO CUTÁNEO'),
(36, 'ELISA (LeVF/VIF)', '400.00', '400.00', 'ELISA'),
(37, 'ELISA (DISTEMPER)', '350.00', '315.00', 'ELISA'),
(38, 'ELISA (4DX HEMOPARÁSITOS)', '420.00', '400.00', 'ELISA'),
(39, 'ELISA (PARVOVIRUS)', '320.00', '300.00', 'ELISA'),
(40, 'ELISA (FELID–3)', '430.00', '410.00', 'ELISA'),
(41, 'URIANÁLISIS', '120.00', '110.00', 'URIANÁLISIS'),
(42, 'PRUEBAS CRUZADAS', '190.00', '190.00', 'PRUEBAS CRUZADAS'),
(43, 'VALOR K', '0.00', '0.00', 'VALOR DE K');

INSERT INTO referencias (referencia_id, descripcion, hematocrito, eritrocitos, hemoglobina, vgm, cgmh, reticulocitos, plaquetas, solidos_totales, fibrinogeno, relacion_ptfib, leucocitos, neutrofilos, bandas, metamielocitos, mielocitos, linfocitos, monocitos, eosinofilos, basofilos, glucosa, urea, creatinina, colesterol, trigliceridos, bilirrubina_total, bilirrubina_conjugada, bilirrubina_no_conjugada, alanina_aminotransferasa, aspartato_aminotransferasa, fosfatasa_alcalina, amilasa, lipasa, creatinacinasa, glutamato_deshidrogenasa, gamaglutamil_transferasa, proteinas_totales, albumina, globulinas, relacion_ag, calcio, fosforo, potasio, sodio, relacion_nak, cloro, bicarbonato, brecha_anionica, diferencia_de_iones_fuertes, osmolalidad, amonio, tiempo_de_tromboplastina, tiempo_de_protrombina, t4_libre, fk_specie_id) VALUES
(1, 'ADULTO', '0.37 - 0.55', '5.5 - 8.5', '120 - 180', '60 - 77', '300 -360', '<60', '200 - 600', '60 - 75', NULL, '0', '6.0 - 17.0', '3.0 - 11.5', '<0.3', '0', '0', '1.0  - 4.8', '0.1 - 1.4', '0 - 0.9', '0', '3.88 - 6.88', '2.1 - 7.9', '60- 130', '2.85 - 7.76', '0.6- 1.2', '1.7 - 5.16', '0 - 4.2', '0 - 2.5', '<70', '<55', '<189', '<1110', '<300', '<213', '0', '0', '56 - 75', '29 -40', '23 - 39', '0.78- 1.46', '2.17 - 2.94', '0.80 - 1.80', '3.8 - 5.4', '141 - 152', '>27', '108 - 117', '17 - 25', '12 - 24', '30 - 40', '280- 305', '0', '0', '0', '0', 1);