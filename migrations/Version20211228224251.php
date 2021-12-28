<?php

declare(strict_types=1);

namespace DoctrineMigrations;

use Doctrine\DBAL\Schema\Schema;
use Doctrine\Migrations\AbstractMigration;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
final class Version20211228224251 extends AbstractMigration
{
    public function getDescription(): string
    {
        return '';
    }

    public function up(Schema $schema): void
    {
        // this up() migration is auto-generated, please modify it to your needs
        $this->addSql('ALTER TABLE course DROP CONSTRAINT course_dept_name_fkey');
        $this->addSql('ALTER TABLE teacher DROP CONSTRAINT teacher_dept_name_fkey');
        $this->addSql('ALTER TABLE student DROP CONSTRAINT student_dept_name_fkey');
        $this->addSql('ALTER TABLE section DROP CONSTRAINT section_course_id_fkey');
        $this->addSql('ALTER TABLE prereq DROP CONSTRAINT prereq_course_id_fkey');
        $this->addSql('ALTER TABLE prereq DROP CONSTRAINT prereq_prereq_id_fkey');
        $this->addSql('ALTER TABLE teaches DROP CONSTRAINT teaches_id_fkey');
        $this->addSql('ALTER TABLE advisor DROP CONSTRAINT advisor_i_id_fkey');
        $this->addSql('ALTER TABLE takes DROP CONSTRAINT takes_course_id_sec_id_semester_year_fkey');
        $this->addSql('ALTER TABLE teaches DROP CONSTRAINT teaches_course_id_sec_id_semester_year_fkey');
        $this->addSql('ALTER TABLE section DROP CONSTRAINT section_building_room_number_fkey');
        $this->addSql('ALTER TABLE takes DROP CONSTRAINT takes_id_fkey');
        $this->addSql('ALTER TABLE advisor DROP CONSTRAINT advisor_s_id_fkey');
        $this->addSql('CREATE SEQUENCE competences_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE realisation_id_seq INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE SEQUENCE "user_id_seq" INCREMENT BY 1 MINVALUE 1 START 1');
        $this->addSql('CREATE TABLE competences (id INT NOT NULL, name VARCHAR(255) NOT NULL, value INT DEFAULT NULL, description TEXT DEFAULT NULL, label VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE realisation (id INT NOT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, website_link VARCHAR(255) DEFAULT NULL, github_link VARCHAR(255) DEFAULT NULL, image_link VARCHAR(255) DEFAULT NULL, created_at TIMESTAMP(0) WITHOUT TIME ZONE NOT NULL, priory INT DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE TABLE "user" (id INT NOT NULL, first_name VARCHAR(255) NOT NULL, last_name VARCHAR(255) NOT NULL, date_of_birth DATE NOT NULL, age INT NOT NULL, adress VARCHAR(255) NOT NULL, nationality VARCHAR(255) NOT NULL, niveau VARCHAR(255) NOT NULL, university VARCHAR(255) NOT NULL, formation VARCHAR(255) DEFAULT NULL, title VARCHAR(255) NOT NULL, description TEXT DEFAULT NULL, resume TEXT DEFAULT NULL, phone_number VARCHAR(255) DEFAULT NULL, email VARCHAR(255) NOT NULL, password VARCHAR(255) NOT NULL, PRIMARY KEY(id))');
        $this->addSql('DROP TABLE takes');
        $this->addSql('DROP TABLE mytable');
        $this->addSql('DROP TABLE department');
        $this->addSql('DROP TABLE course');
        $this->addSql('DROP TABLE teacher');
        $this->addSql('DROP TABLE section');
        $this->addSql('DROP TABLE classroom');
        $this->addSql('DROP TABLE teaches');
        $this->addSql('DROP TABLE student');
        $this->addSql('DROP TABLE advisor');
        $this->addSql('DROP TABLE time_slot');
        $this->addSql('DROP TABLE prereq');
        $this->addSql('DROP TABLE metro');
        $this->addSql('DROP TABLE metros');
    }

    public function down(Schema $schema): void
    {
        // this down() migration is auto-generated, please modify it to your needs
        $this->addSql('CREATE SCHEMA public');
        $this->addSql('DROP SEQUENCE competences_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE realisation_id_seq CASCADE');
        $this->addSql('DROP SEQUENCE "user_id_seq" CASCADE');
        $this->addSql('CREATE TABLE takes (id VARCHAR(5) NOT NULL, course_id VARCHAR(8) NOT NULL, sec_id VARCHAR(8) NOT NULL, semester VARCHAR(6) NOT NULL, year NUMERIC(4, 0) NOT NULL, grade VARCHAR(2) DEFAULT NULL, PRIMARY KEY(id, course_id, sec_id, semester, year))');
        $this->addSql('CREATE INDEX IDX_DCEEBAD1591CC992DD35623EF7388EEDBB827337 ON takes (course_id, sec_id, semester, year)');
        $this->addSql('CREATE INDEX IDX_DCEEBAD1BF396750 ON takes (id)');
        $this->addSql('CREATE TABLE mytable (id INT DEFAULT NULL, age INT DEFAULT NULL)');
        $this->addSql('CREATE TABLE department (dept_name VARCHAR(20) NOT NULL, building VARCHAR(15) DEFAULT NULL, budget NUMERIC(12, 2) DEFAULT NULL, PRIMARY KEY(dept_name))');
        $this->addSql('CREATE TABLE course (course_id VARCHAR(8) NOT NULL, dept_name VARCHAR(20) DEFAULT NULL, title VARCHAR(50) DEFAULT NULL, credits NUMERIC(2, 0) DEFAULT NULL, PRIMARY KEY(course_id))');
        $this->addSql('CREATE INDEX IDX_169E6FB9C6720C25 ON course (dept_name)');
        $this->addSql('CREATE TABLE teacher (id VARCHAR(5) NOT NULL, dept_name VARCHAR(20) DEFAULT NULL, name VARCHAR(20) DEFAULT NULL, salary NUMERIC(8, 2) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B0F6A6D5C6720C25 ON teacher (dept_name)');
        $this->addSql('CREATE TABLE section (course_id VARCHAR(8) NOT NULL, sec_id VARCHAR(8) NOT NULL, semester VARCHAR(6) NOT NULL, year NUMERIC(4, 0) NOT NULL, building VARCHAR(15) DEFAULT NULL, room_number VARCHAR(7) DEFAULT NULL, time_slot_id VARCHAR(4) DEFAULT NULL, PRIMARY KEY(course_id, sec_id, semester, year))');
        $this->addSql('CREATE INDEX IDX_2D737AEF591CC992 ON section (course_id)');
        $this->addSql('CREATE INDEX IDX_2D737AEFE16F61D4D7DED995 ON section (building, room_number)');
        $this->addSql('CREATE TABLE classroom (building VARCHAR(15) NOT NULL, room_number VARCHAR(7) NOT NULL, capacity NUMERIC(4, 0) DEFAULT NULL, PRIMARY KEY(building, room_number))');
        $this->addSql('CREATE TABLE teaches (id VARCHAR(5) NOT NULL, course_id VARCHAR(8) NOT NULL, sec_id VARCHAR(8) NOT NULL, semester VARCHAR(6) NOT NULL, year NUMERIC(4, 0) NOT NULL, PRIMARY KEY(id, course_id, sec_id, semester, year))');
        $this->addSql('CREATE INDEX IDX_C7F19643591CC992DD35623EF7388EEDBB827337 ON teaches (course_id, sec_id, semester, year)');
        $this->addSql('CREATE INDEX IDX_C7F19643BF396750 ON teaches (id)');
        $this->addSql('CREATE TABLE student (id VARCHAR(5) NOT NULL, dept_name VARCHAR(20) DEFAULT NULL, name VARCHAR(20) DEFAULT NULL, tot_cred NUMERIC(3, 0) DEFAULT NULL, PRIMARY KEY(id))');
        $this->addSql('CREATE INDEX IDX_B723AF33C6720C25 ON student (dept_name)');
        $this->addSql('CREATE TABLE advisor (s_id VARCHAR(5) NOT NULL, i_id VARCHAR(5) DEFAULT NULL, PRIMARY KEY(s_id))');
        $this->addSql('CREATE INDEX IDX_19ADC9F4FE6A7BB7 ON advisor (i_id)');
        $this->addSql('CREATE TABLE time_slot (time_slot_id VARCHAR(4) NOT NULL, day VARCHAR(1) NOT NULL, start_hr NUMERIC(2, 0) NOT NULL, start_min NUMERIC(2, 0) NOT NULL, end_hr NUMERIC(2, 0) DEFAULT NULL, end_min NUMERIC(2, 0) DEFAULT NULL, PRIMARY KEY(time_slot_id, day, start_hr, start_min))');
        $this->addSql('CREATE TABLE prereq (course_id VARCHAR(8) NOT NULL, prereq_id VARCHAR(8) NOT NULL, PRIMARY KEY(course_id, prereq_id))');
        $this->addSql('CREATE INDEX IDX_5DF77A8A591CC992 ON prereq (course_id)');
        $this->addSql('CREATE INDEX IDX_5DF77A8A7CEAADF8 ON prereq (prereq_id)');
        $this->addSql('CREATE TABLE metro (geo_point_2d TEXT DEFAULT NULL, geo_shape TEXT DEFAULT NULL, gares_id INT DEFAULT NULL, nom_long TEXT DEFAULT NULL, nom TEXT DEFAULT NULL, nom_sous TEXT DEFAULT NULL, nom_sur TEXT DEFAULT NULL, id_ref_lda INT DEFAULT NULL, nom_lda TEXT DEFAULT NULL, id_ref_zdl INT DEFAULT NULL, nom_zdl TEXT DEFAULT NULL, num_mod INT DEFAULT NULL, mode TEXT DEFAULT NULL, fer TEXT DEFAULT NULL, train TEXT DEFAULT NULL, rer TEXT DEFAULT NULL, metro TEXT DEFAULT NULL, tramway TEXT DEFAULT NULL, navette TEXT DEFAULT NULL, val TEXT DEFAULT NULL, terfer TEXT DEFAULT NULL, tertrain TEXT DEFAULT NULL, terrer TEXT DEFAULT NULL, termetro TEXT DEFAULT NULL, tertram TEXT DEFAULT NULL, ternavette TEXT DEFAULT NULL, terval TEXT DEFAULT NULL, idrefliga TEXT DEFAULT NULL, idrefligc TEXT DEFAULT NULL, ligne TEXT DEFAULT NULL, cod_ligf NUMERIC(3, 1) DEFAULT NULL, ligne_code TEXT DEFAULT NULL, indice_lig TEXT DEFAULT NULL, reseau TEXT DEFAULT NULL, res_com TEXT DEFAULT NULL, exploitant TEXT DEFAULT NULL, num_psr INT DEFAULT NULL, idf TEXT DEFAULT NULL, principal TEXT DEFAULT NULL, x TEXT DEFAULT NULL, y TEXT DEFAULT NULL, picto TEXT DEFAULT NULL)');
        $this->addSql('CREATE TABLE metros (latitude NUMERIC(10, 6) DEFAULT NULL, longitude NUMERIC(10, 6) DEFAULT NULL, geo_shape TEXT DEFAULT NULL, gares_id INT DEFAULT NULL, nom_long TEXT DEFAULT NULL, nom TEXT DEFAULT NULL, nom_sous TEXT DEFAULT NULL, nom_sur TEXT DEFAULT NULL, id_ref_lda INT DEFAULT NULL, nom_lda TEXT DEFAULT NULL, id_ref_zdl INT DEFAULT NULL, nom_zdl TEXT DEFAULT NULL, num_mod TEXT DEFAULT NULL, mode TEXT DEFAULT NULL, fer TEXT DEFAULT NULL, train TEXT DEFAULT NULL, rer TEXT DEFAULT NULL, metro TEXT DEFAULT NULL, tramway TEXT DEFAULT NULL, navette TEXT DEFAULT NULL, val TEXT DEFAULT NULL, terfer TEXT DEFAULT NULL, tertrain TEXT DEFAULT NULL, terrer TEXT DEFAULT NULL, termetro TEXT DEFAULT NULL, tertram TEXT DEFAULT NULL, ternavette TEXT DEFAULT NULL, terval TEXT DEFAULT NULL, idrefliga TEXT DEFAULT NULL, idrefligc TEXT DEFAULT NULL, ligne TEXT DEFAULT NULL, cod_ligf NUMERIC(3, 1) DEFAULT NULL, ligne_code TEXT DEFAULT NULL, indice_lig TEXT DEFAULT NULL, reseau TEXT DEFAULT NULL, res_com TEXT DEFAULT NULL, exploitant TEXT DEFAULT NULL, num_psr INT DEFAULT NULL, idf TEXT DEFAULT NULL, principal TEXT DEFAULT NULL, x TEXT DEFAULT NULL, y TEXT DEFAULT NULL, picto TEXT DEFAULT NULL)');
        $this->addSql('ALTER TABLE takes ADD CONSTRAINT takes_course_id_sec_id_semester_year_fkey FOREIGN KEY (course_id, sec_id, semester, year) REFERENCES section (course_id, sec_id, semester, year) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE takes ADD CONSTRAINT takes_id_fkey FOREIGN KEY (id) REFERENCES student (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE course ADD CONSTRAINT course_dept_name_fkey FOREIGN KEY (dept_name) REFERENCES department (dept_name) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE teacher ADD CONSTRAINT teacher_dept_name_fkey FOREIGN KEY (dept_name) REFERENCES department (dept_name) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT section_course_id_fkey FOREIGN KEY (course_id) REFERENCES course (course_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE section ADD CONSTRAINT section_building_room_number_fkey FOREIGN KEY (building, room_number) REFERENCES classroom (building, room_number) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE teaches ADD CONSTRAINT teaches_course_id_sec_id_semester_year_fkey FOREIGN KEY (course_id, sec_id, semester, year) REFERENCES section (course_id, sec_id, semester, year) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE teaches ADD CONSTRAINT teaches_id_fkey FOREIGN KEY (id) REFERENCES teacher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE student ADD CONSTRAINT student_dept_name_fkey FOREIGN KEY (dept_name) REFERENCES department (dept_name) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE advisor ADD CONSTRAINT advisor_i_id_fkey FOREIGN KEY (i_id) REFERENCES teacher (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE advisor ADD CONSTRAINT advisor_s_id_fkey FOREIGN KEY (s_id) REFERENCES student (id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prereq ADD CONSTRAINT prereq_course_id_fkey FOREIGN KEY (course_id) REFERENCES course (course_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('ALTER TABLE prereq ADD CONSTRAINT prereq_prereq_id_fkey FOREIGN KEY (prereq_id) REFERENCES course (course_id) NOT DEFERRABLE INITIALLY IMMEDIATE');
        $this->addSql('DROP TABLE competences');
        $this->addSql('DROP TABLE realisation');
        $this->addSql('DROP TABLE "user"');
    }
}
