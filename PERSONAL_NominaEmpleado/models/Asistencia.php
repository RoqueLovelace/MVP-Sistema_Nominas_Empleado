<?php
    class Assistance extends Conectar {

        public function registrar_asistencia($employee_id, $time_entry, $time_exit, $work_completed, $time_to_recover, $break_completed, $additional_time, $delay_breaks, $date) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "INSERT INTO assistence (employee_id, time_entry, time_exit, work_completed, time_to_recover, break_completed, additional_time, delay_breaks, date)
                    VALUES (?,?,?,?,?,?,?,?,?)";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $employee_id);
            $sql->bindValue(2, $time_entry);
            $sql->bindValue(3, $time_exit);
            $sql->bindValue(4, $work_completed);
            $sql->bindValue(5, $time_to_recover);
            $sql->bindValue(6, $break_completed);
            $sql->bindValue(7, $additional_time);
            $sql->bindValue(8, $delay_breaks);
            $sql->bindValue(9, $date);
            $sql->execute();

            $sql1 = "SELECT last_insert_id() as 'id'";
            $sql1 = $conectar->prepare($sql1);
            $sql1->execute();
            return $sql1->fetchAll();
        }

        public function get_asistencia_id($id) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM assistence WHERE id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
            return $sql->fetchAll();
        }

        public function get_asistencia_employee_id($employee_id) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "SELECT * FROM assistence WHERE employee_id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $employee_id);
            $sql->execute();
            return $sql->fetchAll();
        }

        public function actualizar_asistencia($id, $employee_id, $time_entry, $time_exit, $work_completed, $time_to_recover, $break_completed, $additional_time, $delay_breaks, $date) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "UPDATE assistence 
                    SET employee_id = ?, time_entry = ?, time_exit = ?, work_completed = ?, time_to_recover = ?, break_completed = ?, additional_time = ?, delay_breaks = ?, date = ?
                    WHERE id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $employee_id);
            $sql->bindValue(2, $time_entry);
            $sql->bindValue(3, $time_exit);
            $sql->bindValue(4, $work_completed);
            $sql->bindValue(5, $time_to_recover);
            $sql->bindValue(6, $break_completed);
            $sql->bindValue(7, $additional_time);
            $sql->bindValue(8, $delay_breaks);
            $sql->bindValue(9, $date);
            $sql->bindValue(10, $id);
            $sql->execute();
        }

        public function eliminar_asistencia($id) {
            $conectar = parent::conexion();
            parent::set_names();
            $sql = "DELETE FROM assistence WHERE id = ?";
            $sql = $conectar->prepare($sql);
            $sql->bindValue(1, $id);
            $sql->execute();
        }
    }
?>
