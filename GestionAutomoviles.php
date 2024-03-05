<?php

class GestionAutomoviles {
    private $db;
    private $isAuthenticated;

    public function __construct() {
        $this->db = $this->conectarMarcas();
        $this->isAuthenticated = false;
    }

    private function conectarMarcas() {
        try {
            $user = "root";
            $pass = "root";
            $dbname = "coches";
            $host = "127.0.0.1";

            $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $pass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            error_log("Se ha conectado a la BD $dbname.", 0);
            return $db;
        } catch (PDOException $e) {
            error_log("Error: No se pudo conectar con la BD $dbname.", 0);
            error_log("Error: " . $e->getMessage(), 0);
            exit();
        }
    }

    public function ObtenerMarcasUrl() {
        $sql = "SELECT marca, url FROM marcas";
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $marcasUrls = [];

        foreach ($result as $row) {
            $marcasUrls[$row["marca"]] = $row["url"];
        }

        return $marcasUrls;
    }


    public function ObtenerModelosPorMarca($marca) {
        try {
            $sql = "SELECT m.modelo FROM modelos m INNER JOIN marcas ma ON m.marca = ma.id WHERE ma.marca = :marca";
            $stmt = $this->db->prepare($sql);
            $stmt->bindParam(':marca', $marca);
            $stmt->execute();
            $modelos = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $modelos_nombres = array();
            foreach ($modelos as $modelo) {
                $modelos_nombres[] = $modelo['modelo'];
            }

            return $modelos_nombres;
        } catch (PDOException $e) {
            error_log("Error al obtener modelos por marca: " . $e->getMessage());
            return array();
        }
    }


    public function authenticate() {
        $this->isAuthenticated = true;
        return true;
    }
}

?>