<?php

namespace Database\Seeders;

use App\Models\Municipio;
use Illuminate\Database\Seeder;

class municipioSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $municipiosGuatemala = [
            'Guatemala',
            'Santa Catarina Pinula',
            'San José Pinula',
            'San José del Golfo',
            'Palencia',
            'Chinautla',
            'San Pedro Ayampuc',
            'Mixco',
            'San Pedro Sacatepéquez',
            'San Juan Sacatepéquez',
            'San Raymundo',
            'Chuarrancho',
            'Fraijanes',
            'Amatitlán',
            'Villa Nueva',
            'Villa Canales',
            'Petapa'
        ];
        foreach ($municipiosGuatemala as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 1,  // ID de Guatemala
            ]);
        }
        $municipiosProgreso = [
            'Guastatoya',
            'Morazán',
            'San Agustín Acasaguastlán',
            'San Cristóbal Acasaguastlán',
            'El Jícaro',
            'Sansare',
            'San Antonio La Paz',
            'Sanarate'
        ];

        foreach ($municipiosProgreso as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 2,  // ID de El Progreso
            ]);
        }
        $municipiosSacatepequez = [
            'Antigua Guatemala',
            'Ciudad Vieja',
            'Jocotenango',
            'Pastores',
            'Sumpango',
            'Santo Domingo Xenacoj',
            'Santiago Sacatepéquez',
            'San Bartolomé Milpas Altas',
            'San Lucas Sacatepéquez',
            'Santa Lucía Milpas Altas',
            'Magdalena Milpas Altas',
            'Santa María de Jesús',
            'San Miguel Dueñas',
            'Alotenango',
            'San Juan Alotenango'
        ];
        foreach ($municipiosSacatepequez as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 3,  // ID de Sacatepequez
            ]);
        }
        
        $municipiosChimaltenango = [
            'Chimaltenango',
            'San José Poaquil',
            'San Martín Jilotepeque',
            'San Juan Comalapa',
            'Santa Apolonia',
            'Tecpán Guatemala',
            'Patzún',
            'Pochuta',
            'Patzicía',
            'Santa Cruz Balanyá',
            'Acatenango',
            'Yepocapa',
            'San Andrés Itzapa',
            'Parramos',
            'Zaragoza',
            'El Tejar'
        ];
        
        foreach ($municipiosChimaltenango as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 4,  // ID de Chimaltenango
            ]);
        }
        $municipiosEscuintla = [
            'Escuintla',
            'Santa Lucía Cotzumalguapa',
            'La Democracia',
            'Siquinalá',
            'Masagua',
            'Tiquisate',
            'La Gomera',
            'Guanagazapa',
            'Puerto San José',
            'Iztapa',
            'Palín',
            'San Vicente Pacaya',
            'Nueva Concepción'
        ];
        foreach ($municipiosEscuintla as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 5,  // ID de Escuintla
            ]);
        }
        
        $municipiosSantaRosa = [
            'Cuilapa',
            'Barberena',
            'Santa Rosa de Lima',
            'Casillas',
            'San Rafael Las Flores',
            'Oratorio',
            'San Juan Tecuaco',
            'Chiquimulilla',
            'Taxisco',
            'Santa María Ixhuatán',
            'Guazacapán',
            'Santa Cruz Naranjo',
            'Pueblo Nuevo Viñas',
            'Nueva Santa Rosa'
        ];
        foreach ($municipiosSantaRosa as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 6,  // ID de Escuintla
            ]);
        }

        $municipiosSolola = [
            'Sololá',
            'Concepción',
            'Nahualá',
            'Panajachel',
            'San Andrés Semetabaj',
            'San Antonio Palopó',
            'San José Chacayá',
            'San Juan La Laguna',
            'San Lucas Tolimán',
            'San Marcos La Laguna',
            'San Pablo La Laguna',
            'San Pedro La Laguna',
            'Santa Catarina Ixtahuacán',
            'Santa Catarina Palopó',
            'Santa Clara La Laguna',
            'Santa Cruz La Laguna',
            'Santa Lucía Utatlán',
            'Santa María Visitación',
            'Santiago Atitlán'
        ];
        foreach ($municipiosSolola as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 7,  // ID de solola
            ]);
        }

        $municipiosTotonicapan = [
            'Totonicapán',
            'San Cristóbal Totonicapán',
            'San Francisco El Alto',
            'San Andrés Xecul',
            'Momostenango',
            'Santa María Chiquimula',
            'Santa Lucía La Reforma',
            'San Bartolo'
        ];
        foreach ($municipiosTotonicapan as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 8,  // ID de Totonicapan
            ]);
        }

        $municipiosQuetzaltenango = [
            'Quetzaltenango',
            'Salcajá',
            'Olintepeque',
            'San Carlos Sija',
            'Sibilia',
            'Cabricán',
            'Cajolá',
            'San Miguel Sigüilá',
            'Ostuncalco',
            'San Mateo',
            'Concepción Chiquirichapa',
            'San Martín Sacatepéquez',
            'Almolonga',
            'Cantel',
            'Huitán',
            'Zunil',
            'Colomba',
            'San Francisco La Unión',
            'El Palmar',
            'Coatepeque',
            'Génova',
            'Flores Costa Cuca',
            'La Esperanza',
            'Palestina de Los Altos'
        ];
        foreach ($municipiosQuetzaltenango as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 9,  // ID de Quetzaltenango
            ]);
        }        

        $municipiosSuchitepequez = [
            'Mazatenango',
            'Cuyotenango',
            'San Francisco Zapotitlán',
            'San Bernardino',
            'San José El Idolo',
            'Santo Domingo Suchitepéquez',
            'San Lorenzo',
            'Samayac',
            'San Pablo Jocopilas',
            'San Antonio Suchitepéquez',
            'San Miguel Panán',
            'San Gabriel',
            'Chicacao',
            'Patulul',
            'Santa Bárbara',
            'San Juan Bautista',
            'Santo Tomás La Unión',
            'Zunilito',
            'Pueblo Nuevo',
            'Río Bravo'
        ];
        foreach ($municipiosSuchitepequez as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 10,  // ID de Suchitepéquez
            ]);
        }

        $municipiosRetalhuleu = [
            'Retalhuleu',
            'San Sebastián',
            'Santa Cruz Mulúa',
            'San Martín Zapotitlán',
            'San Felipe',
            'San Andrés Villa Seca',
            'Champerico',
            'Nuevo San Carlos',
            'El Asintal'
        ];
        foreach ($municipiosRetalhuleu as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 11,  // ID de Retalhuleu
            ]);
        }

        $municipiosSanMarcos = [
            'San Pedro Sacatepéquez',
            'San Antonio Sacatepéquez',
            'Comitancillo',
            'San Miguel Ixtahuacán',
            'Concepción Tutuapa',
            'Tacaná',
            'Sibinal',
            'Tajumulco',
            'Tejutla',
            'San Rafael Pie de La Cuesta',
            'Nuevo Progreso',
            'El Tumbador',
            'San José Ojetenam',
            'Ixcaquixtla',
            'San Cristóbal Cucho',
            'Santo Domingo',
            'San Lorenzo',
            'La Blanca',
            'San Marcos',
            'San Pedro Sacatepéquez',
            'San Antonio Sacatepéquez',
            'Comitancillo',
            'San Miguel Ixtahuacán',
            'Concepción Tutuapa',
            'Tacaná',
            'Sibinal',
            'Tajumulco',
            'Tejutla',
            'San Rafael Pie de La Cuesta',
            'Nuevo Progreso',
            'El Tumbador',
            'San José Ojetenam',
            'Ixcaquixtla',
            'San Cristóbal Cucho',
            'Santo Domingo',
            'San Lorenzo',
            'La Blanca'
        ];
        foreach ($municipiosSanMarcos as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 12,  // ID de San Marcos
            ]);
        }

        $municipiosHuehuetenango = [
            'Huehuetenango',
            'Chiantla',
            'Malacatancito',
            'Cuilco',
            'Nentón',
            'San Pedro Necta',
            'Jacaltenango',
            'Soloma',
            'San Miguel Acatán',
            'San Rafael La Independencia',
            'Todos Santos Cuchumatán',
            'San Juan Atitán',
            'Santa Eulalia',
            'San Mateo Ixtatán',
            'Colotenango',
            'San Sebastián Huehuetenango',
            'Tectitán',
            'Concepción Huista',
            'San Juan Ixcoy',
            'San Antonio Huista',
            'San Sebastián Coatan',
            'Santa Cruz Barillas',
            'San Antonio Huista',
            'San Sebastián Coatan',
            'Santa Cruz Barillas',
            'Aguacatán',
            'San Rafael La Independencia',
            'San Juan Atitán',
            'Santa Eulalia',
            'San Mateo Ixtatán',
            'Colotenango',
            'San Sebastián Huehuetenango',
            'Tectitán',
            'Concepción Huista',
            'San Juan Ixcoy',
            'San Antonio Huista',
            'San Sebastián Coatan',
            'Santa Cruz Barillas',
            'Aguacatán'
        ];
        foreach ($municipiosHuehuetenango as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 13,  // ID de Huehuetenango
            ]);
        }

        $municipiosQuiche = [
            'Santa Cruz del Quiché',
            'Chiché',
            'Chinique',
            'Zacualpa',
            'Chajul',
            'Chichicastenango',
            'Patzité',
            'San Antonio Ilotenango',
            'San Pedro Jocopilas',
            'Cunén',
            'San Juan Cotzal',
            'Joyabaj',
            'Nebaj',
            'San Andrés Sajcabajá',
            'Uspantán',
            'Sacapulas',
            'San Bartolomé Jocotenango',
            'Canillá',
            'Chicamán',
            'Pachalum'
        ];
        foreach ($municipiosQuiche as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 14,  // ID de Quiche
            ]);
        }

        $municipiosBajaVerapaz = [
            'Salamá',
            'San Miguel Chicaj',
            'Rabinal',
            'Cubulco',
            'Granados',
            'Santa Cruz El Chol',
            'San Jerónimo',
            'Purulhá'
        ];
        foreach ($municipiosBajaVerapaz as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 15,  // ID de Baja Verapaz
            ]);
        }

        $municipiosAltaVerapaz = [
            'Cobán',
            'Santa Cruz Verapaz',
            'San Cristóbal Verapaz',
            'Tactic',
            'Tamahú',
            'Tucurú',
            'Panzós',
            'Senahú',
            'San Pedro Carchá',
            'San Juan Chamelco',
            'Lanquín',
            'Santa María Cahabón',
            'Chisec',
            'Chahal',
            'Fray Bartolomé de las Casas',
            'La Tinta',
            'Raxruhá'
        ];
        foreach ($municipiosAltaVerapaz as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 16,  // ID de Alta Verapaz
            ]);
        }

        $municipiosPeten = [
            'Flores',
            'Santa Elena',
            'San Francisco',
            'San José',
            'San Benito',
            'San Andrés',
            'La Libertad',
            'San Luis',
            'Sayaxché',
            'Melchor de Mencos',
            'Poptún',
            'Dolores',
            'San Luis',
            'Las Cruces',
            'El Chal'
        ];
        foreach ($municipiosPeten as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 17,  // ID de Peten
            ]);
        }

        $municipiosIzabal = [
            'Puerto Barrios',
            'Livingston',
            'El Estor',
            'Morales',
            'Los Amates'
        ];
        foreach ($municipiosIzabal as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 18,  // ID de Izabal
            ]);
        }

        $municipiosZacapa = [
            'Zacapa',
            'Estanzuela',
            'Río Hondo',
            'Gualán',
            'Teculután',
            'Usumatlán',
            'Cabañas',
            'Huite',
            'San Diego',
            'La Unión',
            'Huite',
            'San Diego',
            'La Unión'
        ];
        foreach ($municipiosZacapa as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 19,  // ID de Zacapa
            ]);
        }

        $municipiosChiquimula = [
            'Chiquimula',
            'San José La Arada',
            'San Juan Ermita',
            'Jocotán',
            'Camotán',
            'Olopa',
            'Esquipulas',
            'Concepción Las Minas',
            'Quezaltepeque'
        ];
        foreach ($municipiosChiquimula as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 20,  // ID de Chiquimula
            ]);
        }
        
        $municipiosJalapa = [
            'Jalapa',
            'San Pedro Pinula',
            'San Luis Jilotepeque',
            'San Manuel Chaparrón',
            'San Carlos Alzatate',
            'Monjas',
            'Mataquescuintla'
        ];
        foreach ($municipiosJalapa as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 21,  // ID de Jalapa
            ]);
        }

        $municipiosJutiapa = [
            'Jutiapa',
            'El Progreso',
            'Santa Catarina Mita',
            'Agua Blanca',
            'Asunción Mita',
            'Yupiltepeque',
            'Atescatempa',
            'Jerez',
            'El Adelanto',
            'Zapotitlán',
            'Comapa',
            'Jalpatagua',
            'Conguaco',
            'Moyuta',
            'Pasaco',
            'San José Acatempa',
            'Quesada'
        ];
        foreach ($municipiosJutiapa as $municipio) {
            Municipio::create([
                'municipio' => $municipio,
                'departamento_id' => 22,  // ID de Jutiapa
            ]);
        }

    }
}
