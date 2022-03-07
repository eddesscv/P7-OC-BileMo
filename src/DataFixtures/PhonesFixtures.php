<?php

namespace App\DataFixtures;

use App\Entity\Phone;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class PhonesFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        foreach ($this->getProductData() as [$title, $description, $price, $color, $size, $weight]) {
            $product = new Phone();
            $product->setTitle($title);
            $product->setDescription($description);
            $product->setPrice($price);
            $product->setColor($color);
            $product->setSize($size);
            $product->setWeight($weight);
            $manager->persist($product);
        }

        $manager->flush();
    }

    private function getProductData(): array
    {
        return [
            // [$title, $description, $price, $color, $size, $weight];
            ['Iphone 12', 'L\'iPhone 12 est le modèle principal de la 14e génération de smartphone d\'Apple annoncé le 13 octobre 2020. Il est équipé d\'un écran de 6,1 pouces OLED HDR 60 Hz, d\'un double capteur photo avec ultra grand-angle et d\'un SoC Apple A14 Bionic compatible 5G (sub-6 GHz).', '739.00 €', 'Argent', '6.1 pouces', '162 g'],
            ['Samsung Galaxy A50', 'Le Samsung Galaxy A50 (A5 2019) a été officialisé le 25 février 2019. Il propose un écran Super AMOLED, trois caméras à l\'arrière, Samsung One...', '263.00 €', 'Noir', '6.4 pouces', '168 g'],
            ['Samsung Galaxy A10', 'Le Samsung Galaxy A10 est un smartphone d\'entrée de gamme annoncé en mars 2019. Il est équipé d\'un écran IPS LCD de 6,2 pouces avec...', '133.00 €', 'Golden', '6.2 pouces', '168 g'],
            ['Samsung Galaxy A30', 'Le Samsung Galaxy A30 a été officialisé en février 2019. Il propose un grand écran de 6,4 pouces Super AMOLED, l\'Exynos 7904 et un capteur...', '195.00 €', 'Silver', '6.4 pouces', '158 g'],
            ['Huawei P30 Pro', 'Le Huawei P30 Pro serait le prochain flagship du constructeur chinois. Équipé d\'une puce Kirin 980, il devrait disposer d\'un quadruple capteur photo compatible zoom...', '794.00 €', 'Noir', '6.4 pouces', '192 g'],
            ['Huawei P30', 'Le Huawei P30 a été annoncé le 26 mars 2019. Équipé d\'une puce Kirin 980, il devrait disposer d\'un triple capteur photo à son dos,...', '584.00 €', 'Blanc', '5.8 pouces', '165 g'],
            ['Huawei P20 Pro', 'Le Huawei P20 Pro est la version grand format du nouveau flagship de Huawei annoncé le 27 Mars 2018 à Paris. Il dispose d\'un SoC...', '434.00 €', 'Noir', '6.1 pouces', '180 g']
        ];
    }
}
