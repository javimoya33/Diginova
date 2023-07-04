<?php

require_once base_path().'/fpdf/fpdf.php';

    class PDF_Code128Parte extends FPDF
    {
        protected $T128;                                         // Tableau des codes 128
        protected $ABCset = "";                                  // jeu des caractères éligibles au C128
        protected $Aset = "";                                    // Set A du jeu des caractères éligibles
        protected $Bset = "";                                    // Set B du jeu des caractères éligibles
        protected $Cset = "";                                    // Set C du jeu des caractères éligibles
        protected $SetFrom;                                      // Convertisseur source des jeux vers le tableau
        protected $SetTo;                                        // Convertisseur destination des jeux vers le tableau
        protected $JStart = array("A"=>103, "B"=>104, "C"=>105); // Caractères de sélection de jeu au début du C128
        protected $JSwap = array("A"=>101, "B"=>100, "C"=>99);   // Caractères de changement de jeu

        //____________________________ Extension du constructeur _______________________
        function __construct($orientation='P', $unit='mm', $format='A4') 
        {

            parent::__construct($orientation,$unit,$format);

            $this->T128[] = array(2, 1, 2, 2, 2, 2);           //0 : [ ]               // composition des caractères
            $this->T128[] = array(2, 2, 2, 1, 2, 2);           //1 : [!]
            $this->T128[] = array(2, 2, 2, 2, 2, 1);           //2 : ["]
            $this->T128[] = array(1, 2, 1, 2, 2, 3);           //3 : [#]
            $this->T128[] = array(1, 2, 1, 3, 2, 2);           //4 : [$]
            $this->T128[] = array(1, 3, 1, 2, 2, 2);           //5 : [%]
            $this->T128[] = array(1, 2, 2, 2, 1, 3);           //6 : [&]
            $this->T128[] = array(1, 2, 2, 3, 1, 2);           //7 : [']
            $this->T128[] = array(1, 3, 2, 2, 1, 2);           //8 : [(]
            $this->T128[] = array(2, 2, 1, 2, 1, 3);           //9 : [)]
            $this->T128[] = array(2, 2, 1, 3, 1, 2);           //10 : [*]
            $this->T128[] = array(2, 3, 1, 2, 1, 2);           //11 : [+]
            $this->T128[] = array(1, 1, 2, 2, 3, 2);           //12 : [,]
            $this->T128[] = array(1, 2, 2, 1, 3, 2);           //13 : [-]
            $this->T128[] = array(1, 2, 2, 2, 3, 1);           //14 : [.]
            $this->T128[] = array(1, 1, 3, 2, 2, 2);           //15 : [/]
            $this->T128[] = array(1, 2, 3, 1, 2, 2);           //16 : [0]
            $this->T128[] = array(1, 2, 3, 2, 2, 1);           //17 : [1]
            $this->T128[] = array(2, 2, 3, 2, 1, 1);           //18 : [2]
            $this->T128[] = array(2, 2, 1, 1, 3, 2);           //19 : [3]
            $this->T128[] = array(2, 2, 1, 2, 3, 1);           //20 : [4]
            $this->T128[] = array(2, 1, 3, 2, 1, 2);           //21 : [5]
            $this->T128[] = array(2, 2, 3, 1, 1, 2);           //22 : [6]
            $this->T128[] = array(3, 1, 2, 1, 3, 1);           //23 : [7]
            $this->T128[] = array(3, 1, 1, 2, 2, 2);           //24 : [8]
            $this->T128[] = array(3, 2, 1, 1, 2, 2);           //25 : [9]
            $this->T128[] = array(3, 2, 1, 2, 2, 1);           //26 : [:]
            $this->T128[] = array(3, 1, 2, 2, 1, 2);           //27 : [;]
            $this->T128[] = array(3, 2, 2, 1, 1, 2);           //28 : [<]
            $this->T128[] = array(3, 2, 2, 2, 1, 1);           //29 : [=]
            $this->T128[] = array(2, 1, 2, 1, 2, 3);           //30 : [>]
            $this->T128[] = array(2, 1, 2, 3, 2, 1);           //31 : [?]
            $this->T128[] = array(2, 3, 2, 1, 2, 1);           //32 : [@]
            $this->T128[] = array(1, 1, 1, 3, 2, 3);           //33 : [A]
            $this->T128[] = array(1, 3, 1, 1, 2, 3);           //34 : [B]
            $this->T128[] = array(1, 3, 1, 3, 2, 1);           //35 : [C]
            $this->T128[] = array(1, 1, 2, 3, 1, 3);           //36 : [D]
            $this->T128[] = array(1, 3, 2, 1, 1, 3);           //37 : [E]
            $this->T128[] = array(1, 3, 2, 3, 1, 1);           //38 : [F]
            $this->T128[] = array(2, 1, 1, 3, 1, 3);           //39 : [G]
            $this->T128[] = array(2, 3, 1, 1, 1, 3);           //40 : [H]
            $this->T128[] = array(2, 3, 1, 3, 1, 1);           //41 : [I]
            $this->T128[] = array(1, 1, 2, 1, 3, 3);           //42 : [J]
            $this->T128[] = array(1, 1, 2, 3, 3, 1);           //43 : [K]
            $this->T128[] = array(1, 3, 2, 1, 3, 1);           //44 : [L]
            $this->T128[] = array(1, 1, 3, 1, 2, 3);           //45 : [M]
            $this->T128[] = array(1, 1, 3, 3, 2, 1);           //46 : [N]
            $this->T128[] = array(1, 3, 3, 1, 2, 1);           //47 : [O]
            $this->T128[] = array(3, 1, 3, 1, 2, 1);           //48 : [P]
            $this->T128[] = array(2, 1, 1, 3, 3, 1);           //49 : [Q]
            $this->T128[] = array(2, 3, 1, 1, 3, 1);           //50 : [R]
            $this->T128[] = array(2, 1, 3, 1, 1, 3);           //51 : [S]
            $this->T128[] = array(2, 1, 3, 3, 1, 1);           //52 : [T]
            $this->T128[] = array(2, 1, 3, 1, 3, 1);           //53 : [U]
            $this->T128[] = array(3, 1, 1, 1, 2, 3);           //54 : [V]
            $this->T128[] = array(3, 1, 1, 3, 2, 1);           //55 : [W]
            $this->T128[] = array(3, 3, 1, 1, 2, 1);           //56 : [X]
            $this->T128[] = array(3, 1, 2, 1, 1, 3);           //57 : [Y]
            $this->T128[] = array(3, 1, 2, 3, 1, 1);           //58 : [Z]
            $this->T128[] = array(3, 3, 2, 1, 1, 1);           //59 : [[]
            $this->T128[] = array(3, 1, 4, 1, 1, 1);           //60 : [\]
            $this->T128[] = array(2, 2, 1, 4, 1, 1);           //61 : []]
            $this->T128[] = array(4, 3, 1, 1, 1, 1);           //62 : [^]
            $this->T128[] = array(1, 1, 1, 2, 2, 4);           //63 : [_]
            $this->T128[] = array(1, 1, 1, 4, 2, 2);           //64 : [`]
            $this->T128[] = array(1, 2, 1, 1, 2, 4);           //65 : [a]
            $this->T128[] = array(1, 2, 1, 4, 2, 1);           //66 : [b]
            $this->T128[] = array(1, 4, 1, 1, 2, 2);           //67 : [c]
            $this->T128[] = array(1, 4, 1, 2, 2, 1);           //68 : [d]
            $this->T128[] = array(1, 1, 2, 2, 1, 4);           //69 : [e]
            $this->T128[] = array(1, 1, 2, 4, 1, 2);           //70 : [f]
            $this->T128[] = array(1, 2, 2, 1, 1, 4);           //71 : [g]
            $this->T128[] = array(1, 2, 2, 4, 1, 1);           //72 : [h]
            $this->T128[] = array(1, 4, 2, 1, 1, 2);           //73 : [i]
            $this->T128[] = array(1, 4, 2, 2, 1, 1);           //74 : [j]
            $this->T128[] = array(2, 4, 1, 2, 1, 1);           //75 : [k]
            $this->T128[] = array(2, 2, 1, 1, 1, 4);           //76 : [l]
            $this->T128[] = array(4, 1, 3, 1, 1, 1);           //77 : [m]
            $this->T128[] = array(2, 4, 1, 1, 1, 2);           //78 : [n]
            $this->T128[] = array(1, 3, 4, 1, 1, 1);           //79 : [o]
            $this->T128[] = array(1, 1, 1, 2, 4, 2);           //80 : [p]
            $this->T128[] = array(1, 2, 1, 1, 4, 2);           //81 : [q]
            $this->T128[] = array(1, 2, 1, 2, 4, 1);           //82 : [r]
            $this->T128[] = array(1, 1, 4, 2, 1, 2);           //83 : [s]
            $this->T128[] = array(1, 2, 4, 1, 1, 2);           //84 : [t]
            $this->T128[] = array(1, 2, 4, 2, 1, 1);           //85 : [u]
            $this->T128[] = array(4, 1, 1, 2, 1, 2);           //86 : [v]
            $this->T128[] = array(4, 2, 1, 1, 1, 2);           //87 : [w]
            $this->T128[] = array(4, 2, 1, 2, 1, 1);           //88 : [x]
            $this->T128[] = array(2, 1, 2, 1, 4, 1);           //89 : [y]
            $this->T128[] = array(2, 1, 4, 1, 2, 1);           //90 : [z]
            $this->T128[] = array(4, 1, 2, 1, 2, 1);           //91 : [{]
            $this->T128[] = array(1, 1, 1, 1, 4, 3);           //92 : [|]
            $this->T128[] = array(1, 1, 1, 3, 4, 1);           //93 : [}]
            $this->T128[] = array(1, 3, 1, 1, 4, 1);           //94 : [~]
            $this->T128[] = array(1, 1, 4, 1, 1, 3);           //95 : [DEL]
            $this->T128[] = array(1, 1, 4, 3, 1, 1);           //96 : [FNC3]
            $this->T128[] = array(4, 1, 1, 1, 1, 3);           //97 : [FNC2]
            $this->T128[] = array(4, 1, 1, 3, 1, 1);           //98 : [SHIFT]
            $this->T128[] = array(1, 1, 3, 1, 4, 1);           //99 : [Cswap]
            $this->T128[] = array(1, 1, 4, 1, 3, 1);           //100 : [Bswap]                
            $this->T128[] = array(3, 1, 1, 1, 4, 1);           //101 : [Aswap]
            $this->T128[] = array(4, 1, 1, 1, 3, 1);           //102 : [FNC1]
            $this->T128[] = array(2, 1, 1, 4, 1, 2);           //103 : [Astart]
            $this->T128[] = array(2, 1, 1, 2, 1, 4);           //104 : [Bstart]
            $this->T128[] = array(2, 1, 1, 2, 3, 2);           //105 : [Cstart]
            $this->T128[] = array(2, 3, 3, 1, 1, 1);           //106 : [STOP]
            $this->T128[] = array(2, 1);                       //107 : [END BAR]

            for ($i = 32; $i <= 95; $i++) {                                            // jeux de caractères
                $this->ABCset .= chr($i);
            }
            $this->Aset = $this->ABCset;
            $this->Bset = $this->ABCset;
            
            for ($i = 0; $i <= 31; $i++) {
                $this->ABCset .= chr($i);
                $this->Aset .= chr($i);
            }
            for ($i = 96; $i <= 127; $i++) {
                $this->ABCset .= chr($i);
                $this->Bset .= chr($i);
            }
            for ($i = 200; $i <= 210; $i++) {                                           // controle 128
                $this->ABCset .= chr($i);
                $this->Aset .= chr($i);
                $this->Bset .= chr($i);
            }
            $this->Cset="0123456789".chr(206);

            for ($i=0; $i<96; $i++) {                                                   // convertisseurs des jeux A & B
                @$this->SetFrom["A"] .= chr($i);
                @$this->SetFrom["B"] .= chr($i + 32);
                @$this->SetTo["A"] .= chr(($i < 32) ? $i+64 : $i-32);
                @$this->SetTo["B"] .= chr($i);
            }
            for ($i=96; $i<107; $i++) {                                                 // contrôle des jeux A & B
                @$this->SetFrom["A"] .= chr($i + 104);
                @$this->SetFrom["B"] .= chr($i + 104);
                @$this->SetTo["A"] .= chr($i);
                @$this->SetTo["B"] .= chr($i);
            }
        }

        //________________ Fonction encodage et dessin du code 128 _____________________
        function Code128($x, $y, $code, $w, $h) 
        {
            $Aguid = "";                                                                      // Création des guides de choix ABC
            $Bguid = "";
            $Cguid = "";
            for ($i=0; $i < strlen($code); $i++) {
                $needle = substr($code,$i,1);
                $Aguid .= ((strpos($this->Aset,$needle)===false) ? "N" : "O"); 
                $Bguid .= ((strpos($this->Bset,$needle)===false) ? "N" : "O"); 
                $Cguid .= ((strpos($this->Cset,$needle)===false) ? "N" : "O");
            }

            $SminiC = "OOOO";
            $IminiC = 4;

            $crypt = "";
            while ($code > "") {
                                                                                            // BOUCLE PRINCIPALE DE CODAGE
                $i = strpos($Cguid,$SminiC);                                                // forçage du jeu C, si possible
                if ($i!==false) {
                    $Aguid [$i] = "N";
                    $Bguid [$i] = "N";
                }

                if (substr($Cguid,0,$IminiC) == $SminiC) {                                  // jeu C
                    $crypt .= chr(($crypt > "") ? $this->JSwap["C"] : $this->JStart["C"]);  // début Cstart, sinon Cswap
                    $made = strpos($Cguid,"N");                                             // étendu du set C
                    if ($made === false) {
                        $made = strlen($Cguid);
                    }
                    if (fmod($made,2)==1) {
                        $made--;                                                            // seulement un nombre pair
                    }
                    for ($i=0; $i < $made; $i += 2) {
                        $crypt .= chr(strval(substr($code,$i,2)));                          // conversion 2 par 2
                    }
                    $jeu = "C";
                } else {
                    $madeA = strpos($Aguid,"N");                                            // étendu du set A
                    if ($madeA === false) {
                        $madeA = strlen($Aguid);
                    }
                    $madeB = strpos($Bguid,"N");                                            // étendu du set B
                    if ($madeB === false) {
                        $madeB = strlen($Bguid);
                    }
                    $made = (($madeA < $madeB) ? $madeB : $madeA );                         // étendu traitée
                    $jeu = (($madeA < $madeB) ? "B" : "A" );                                // Jeu en cours

                    $crypt .= chr(($crypt > "") ? $this->JSwap[$jeu] : $this->JStart[$jeu]); // début start, sinon swap

                    $crypt .= strtr(substr($code, 0,$made), $this->SetFrom[$jeu], $this->SetTo[$jeu]); // conversion selon jeu

                }
                $code = substr($code,$made);                                           // raccourcir légende et guides de la zone traitée
                $Aguid = substr($Aguid,$made);
                $Bguid = substr($Bguid,$made);
                $Cguid = substr($Cguid,$made);
            }                                                                          // FIN BOUCLE PRINCIPALE

            $check = ord($crypt[0]);                                                   // calcul de la somme de contrôle
            for ($i=0; $i<strlen($crypt); $i++) {
                $check += (ord($crypt[$i]) * $i);
            }
            $check %= 103;

            $crypt .= chr($check) . chr(106) . chr(107);                               // Chaine cryptée complète

            $i = (strlen($crypt) * 11) - 8;                                            // calcul de la largeur du module
            $modul = $w/$i;

            for ($i=0; $i<strlen($crypt); $i++) {                                      // BOUCLE D'IMPRESSION
                $c = $this->T128[ord($crypt[$i])];
                for ($j=0; $j<count($c); $j++) {
                    $this->Rect($x,$y,$c[$j]*$modul,$h,"F");
                    $x += ($c[$j++]+$c[$j])*$modul;
                }
            }
        }






        var $widths;
        var $aligns;

        // Cabecera de página
        function Header()
        {


        }

        function DatosCabecera($codcli, $nom,$domicilio,$codpostal,$poblacion,$dnicli,$fecha,$numRMA)
        {


            // Logo
            $this -> Image(base_path().'/public/images/diginova1.png',20,12,75);
            $this -> Rect(15, 55, 85,35);

            // Arial bold 15
            $this -> SetFont('Arial','B',18);
            // Movernos a la derecha
            $this -> Ln(16);
            
            $this -> Cell(104);
            $this -> Cell(100,10,'Parte RMA '.$numRMA);
            // Salto de l&iacute;nea
            $this -> Ln(12);

            $this -> SetFont('Arial','B',18);
            $this -> Cell(110);

            $this -> Cell(60,15, "", '0', '0', 'C');

            $this->SetDrawColor(0, 0, 0);
            $this->SetFillColor(0, 0, 0);
            $this->SetTextColor(0, 0, 0);
            $this->Code128(125, 40, "RMA".$numRMA, 50, 10);
            
            // Datos de cliente titulo
            $this -> Ln(18);
            $this -> SetFont('Arial','',12);
            $this -> Cell(10);
            $this -> Cell(80,10,'DATOS CLIENTE   cod. '.$codcli);

            // Datos de cliente titulo DATOS
            $this -> Ln(10);

            /*$this -> SetFont('Arial','',10);
            $this -> MultiCell(90,6,$nom.'\n'.$domicilio,1,'L',false);*/
            $this -> SetFont('Arial','',10);
            $this -> Cell(10);
            $this -> Cell(80,10,utf8_decode($nom));
            $this -> Ln(6);
            $this -> Cell(10);
            $this -> Cell(80,10,utf8_decode($domicilio));
            $this -> Ln(4);
            $this -> Cell(10);
            $this -> Cell(80,10,$codpostal."   ".utf8_decode($poblacion));
            $this -> Ln(4);
            $this -> Cell(10);
            $this -> Cell(80,10,'CIF/NIF: '.$dnicli);

            //Fecha de solicitud
            $this -> SetY(60);
            $this -> Cell(112);
            $this -> SetFont('Arial','B',14);
            $this -> Cell(100,8,'FECHA DE SOLICITUD');
            // Salto de l&iacute;nea
            $this -> Ln(12);

            $this -> SetFont('Arial','B',18);
            $this -> Cell(110);
            $this -> Cell(60,15,$fecha, '1', '0', 'C');


        }

        function EscribirSintomas($resLineas)
        {
            $this -> SetLineWidth(0.4);
            $this -> SetDrawColor(11, 46, 72);
            //$this -> Rect(10, 100, 190,120);
            $this -> SetFont('Arial','B',12);
            // Movernos a la derecha
            $this -> Ln(26);
            
            /*$this -> Cell(6);
            $this -> Cell(10,10,'REFERENCIA');

            $this -> Cell(40);
            $this -> Cell(10,10,'DESCRIPCI&oacute;N');

            $this -> Cell(70);
            $this -> Cell(10,10,'FALLO DETECTADO');*/
            $this -> SetFont('Arial','B',11);
            $this -> SetFillColor(11, 46, 72);
            $this -> SetTextColor(255, 255, 255);
            $this -> MultiCell(190,12,utf8_decode('    REFERENCIA                             DESCRIPCIÓN                                  FALLO DETECTADO'),1,'L',true);

            $this -> SetFont('Arial','',10);
            $this -> SetTextColor(0, 0, 0);
            $this -> Ln(5);
            $x = $this -> GetX();
            $y = $this -> GetY();
            //$y-=10;
            
            $line_width = 60;

            foreach ($resLineas as $linea)
            {
                $this -> SetWidths(array(34, 85, 70));

                // Columna de fallo detectado lleva nombre de fallo más la observación
                $strFalloDetectado = $linea->averia_nombre;
                if ($linea->robservaciones != "") { $strFalloDetectado .= " - ".$linea->robservaciones; }


                $this -> Row(array('   '.$linea->rcodar, utf8_decode($linea->rdescr), utf8_decode($strFalloDetectado) ));
            }

            $this -> Ln(30);
            //MultiCell(float w, float h, string txt [, mixed border [, string align [, boolean fill]]])
            //$this -> SetFillColor(11, 46, 72);
            // $this -> MultiCell(100,5,'Texto prueba tipo celda Texto prueba tipo celda Texto prueba tipo celda Texto prueba tipo celda ',1,'L',true);

        }

        function SetWidths($w)
        {
            //Set the array of column widths
            $this -> widths=$w;
        }

        function SetAligns($a)
        {
            //Set the array of column alignments
            $this -> aligns=$a;
        }

        function Row($data)
        {
            //Calculate the height of the row
            $nb=0;
            for($i=0;$i<count($data);$i++)
                $nb=max($nb, $this -> NbLines($this -> widths[$i], $data[$i]));
            $h=5*$nb;
            //Issue a page break first if needed
            $this -> CheckPageBreak($h);
            //Draw the cells of the row
            for($i=0;$i<count($data);$i++)
            {
                $w=$this -> widths[$i];
                $a=isset($this -> aligns[$i]) ? $this -> aligns[$i] : 'L';
                //Save the current position
                $x=$this -> GetX();
                $y=$this -> GetY();
                //Draw the border
                //$this -> Rect($x, $y, $w, $h);
                //Print the text
                $this -> MultiCell($w, 5, $data[$i], 0, $a);
                //Put the position to the right of the cell
                $this -> SetXY($x+$w, $y);
            }
            //Go to the next line
            $this -> Ln($h+5);
        }

        function CheckPageBreak($h)
        {
            //If the height h would cause an overflow, add a new page immediately
            if($this -> GetY()+$h>$this -> PageBreakTrigger)
                $this -> AddPage($this -> CurOrientation);
        }

        function NbLines($w, $txt)
        {
            //Computes the number of lines a MultiCell of width w will take
            $cw=&$this -> CurrentFont['cw'];
            if($w==0)
                $w=$this -> w-$this -> rMargin-$this -> x;
            $wmax=($w-2*$this -> cMargin)*1000/$this -> FontSize;
            $s=str_replace("\r", '', $txt);
            $nb=strlen($s);
            if($nb>0 and $s[$nb-1]=="\n")
                $nb--;
            $sep=-1;
            $i=0;
            $j=0;
            $l=0;
            $nl=1;
            while($i<$nb)
            {
                $c=$s[$i];
                if($c=="\n")
                {
                    $i++;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                    continue;
                }
                if($c==' ')
                    $sep=$i;
                $l+=$cw[$c];
                if($l>$wmax)
                {
                    if($sep==-1)
                    {
                        if($i==$j)
                            $i++;
                    }
                    else
                        $i=$sep+1;
                    $sep=-1;
                    $j=$i;
                    $l=0;
                    $nl++;
                }
                else
                    $i++;
            }
            return $nl;
        }

        function Condiciones()
        {
            $this -> SetFont('Arial','B',16);
            //$this -> SetXY(14, -90);
            //$this -> Ln(16);
            //$this -> Cell(10);
            $this -> Cell(80,10,'Condiciones Generales de RMA');
            $this -> Ln(13);
            //$this -> SetXY(14, -100);
            //$this -> SetXY(14, -80);
            $this -> SetFont('Arial','',7);
            $this -> MultiCell(180,5, utf8_decode('1º LAS SOLICITUDES SE DEBEN REALIZAR UNICAMENTE A TRAVÉS DE NUESTRA PÁGINA WEB, INDICANDO CLARAMENTE EL PROBLEMA QUE PRESENTA EL ARTÍCULO.
                2º LAS DESCRIPCIÓNES TALES COMO “NO FUNCIONA”, “NO VA”, NO SERÁN ADMITIDAS NI PROCESADAS. POR FAVOR, SEA LO MÁS EXPLÍCITO POSIBLE EN LA DESCRIPCIÓN DEL ERROR.
                3º LAS SOLICITUDES DE RMA TIENEN UNA VALIDEZ DE 10 DÍAS. NO SE ACEPTARÁN MERCANCÍAS FUERA DE ESTE PLAZO.
                4º. TODOS LOS ARTÍCULOS ENVIADOS PARA ABONO,DEVOLUCIÓN O RMA, HAN DE SER ENVIADOS A PORTES PAGADOS, POR SU PROPIA AGENCIA. CUALQUIER MERCANCÍA QUE LLEGUE A PORTES DEBIDOS SIN SU CORRESPONDIENTE AUTORIZACIÓN POR PARTE DE NUESTRO DPTO. DE RMA PODRÁ SER DEVUELTA A ORIGEN, SIN PERJUICIO A NUESTRA EMPRESA DE LOS COSTES QUE ESTO PUEDA OCASIONAR
                5º. NOS RESERVAMOS EL DERECHO DE ABONAR UNA MERCANCÍA SI ÉSTA NO TIENE POSIBILIDAD DE REEMPLAZO.
                6º LOS PRODUCTOS DEBERÁN INCLUIR UNA ETIQUETA ADHESIVA INDICATIVA DEL NÚMERO DE ORDEN QUE OCUPAN EN LA SOLICITUD DE RMA, CON EL OBJETO DE FACILITAR LA IDENTIFICACIÓN DEL PRODUCTO.'),0,'L',false);

        }

        // Pie de p&aacute;gina
        function Footer()
        {
        }

    }


?>




    
