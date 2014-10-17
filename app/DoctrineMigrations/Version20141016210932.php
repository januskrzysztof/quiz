<?php

namespace Application\Migrations;

use Doctrine\DBAL\Migrations\AbstractMigration;
use Doctrine\DBAL\Schema\Schema;

/**
 * Auto-generated Migration: Please modify to your needs!
 */
class Version20141016210932 extends AbstractMigration
{
    public function up(Schema $schema)
    {
        $this->addSql('
          INSERT INTO quiz (content, type, options) VALUES
          (\'Jakie miasto jest stolicą polski ?\', \'choice\', \'a:3:{s:8:"expanded";b:1;s:4:"data";s:7:"Kraków";s:7:"choices";a:4:{s:7:"Kraków";s:7:"Kraków";s:6:"Gdynia";s:6:"Gdynia";s:8:"Warszawa";s:8:"Warszawa";s:8:"Wrocław";s:8:"Wrocław";}}\'),
          (\'Kiedy obchodzone jest święto Unii Europejskiej ?\', \'choice\', \'a:3:{s:8:"expanded";b:1;s:4:"data";s:7:"Kraków";s:7:"choices";a:4:{s:16:"18 października";s:16:"18 października";s:8:"7 lutego";s:8:"7 lutego";s:6:"9 maja";s:6:"9 maja";s:11:"21 sierpnia";s:11:"21 sierpnia";}}\'),
          (\'Jak nazywa się waluta, która weszła w obieg 1 stycznia 2001roku?(w państwach należących do UE)\', \'choice\', \'a:3:{s:8:"expanded";b:1;s:4:"data";s:7:"Kraków";s:7:"choices";a:4:{s:6:"złoty";s:6:"złoty";s:5:"dolar";s:5:"dolar";s:4:"euro";s:4:"euro";s:5:"marka";s:5:"marka";}}\'),
          (\'Wymień przynajmniej jednego Bogao przeciwnej mocy Erosa? \', \'text\', \'a:0:{}\'),
          (\'Kto był jedynym królem, który zginął na polu bitwy ?\', \'textarea\', \'a:0:{}\')
        ');
    }

    public function down(Schema $schema)
    {
        // this down() migration is auto-generated, please modify it to your needs

    }
}
