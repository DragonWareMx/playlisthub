<?php

use Illuminate\Database\Seeder;

class Reviews extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'rating' => 4.5,
            'comment' => '"El Amor Brujo" tiene la ardua tarea de seguirle el ritmo a "In Eternum", pero el disco no se detiene en su ritmo y el tercer corte demuestra una cara menos rápida pero más bonachona, sin salir del heavy metal. Ésta se presenta como una amalgama entre los omnipresentes, y acertados, teclados de Javi Díez. Se le puede escuchar con amplia comodidad a Zeta, mientras Patricia Tapia – la cual hace su primera aparición como co-vocalista-, lo acompaña en los estribillos antes del pegajoso puente. El estribillo es súper pegadizo, la letra en los versos es muy guapa y el tema metralla con poder durante su parte media, en donde el ritmo se alenta y se escucha un ritmo arábico, dando la tralla al máximo.',
            'date'=>'2020-08-20',
            'camp_id'=>1,
            'user_id'=>'2'
        ]);
        DB::table('reviews')->insert([
            'rating' => 1,
            'comment' => 'Canción horrible, no me gustó para nada, está muy mal grabada; la calidad es pésima. Me gustaría recibir cosas de calidad, no puedo permitir que algo así entre en mis playlist por lo tanto yo estoy fuera.',
            'date'=>'2020-08-27',
            'camp_id'=>2,
            'user_id'=>'2'
        ]);
        DB::table('reviews')->insert([
            'rating' => 4.5,
            'comment' => '"Te Traeré el Horizonte" es otro acierto (para gusto del redactor) dentro de este trabajo. Empezados con una extraña mezcla (para la habitualidad sonora del grupo) de beats y synths electrónicos, el renombrado Ara Malikian entra para destrozar las cabezas de todos con un exquisito – pero tristemente muy corto – solo de violín, el cual se conecta con la melodía principal del tema, en donde se vislumbra desde muy lejos el "ADN de Oz" que imprime el grupo independiente si está tocando una polka, una ranchera, un hard rock o un power metal alemán. "Te traeré" es un tema más cercano al pop, pero el tema suena muy bien y pese a comentarios de algunos puristas y algunas preguntas de ¿por qué? – a mi me gustaría plantear otra: ¿por qué no?',
            'date'=>'2020-09-11',
            'camp_id'=>3,
            'user_id'=>'2'
        ]);
        DB::table('reviews')->insert([
            'rating' => 5,
            'comment' => 'Ira Dei comienza de manera tétrica con un órgano de iglesia que probablemente estén presagiando el final de los tiempos. Después de ello, 
                        la introducción corre a cargo de una solemnte y hermosa sección en donde las guitarras y Zeta comienzan con la canción. Una vez terminados 
                        los saludos, el tema se metalifica y no en mucho tiempo se vuelve en otro trallazo powermetalero. El estribillo (general) es otro himno 
                        anti-religioso, el cual juega con varias temáticas: las plagas apocalípticas que destrozarán a la humanidad, la relación entre dios y el 
                        diablo, las evidentes declaraciones que rechazan a la iglesia, etcétera.',
            'date'=>'2020-09-12',
            'camp_id'=>4,
            'user_id'=>'2'
        ]);
        
    }
}
