<?php

namespace jove4015\EpubToText\Test;

use PHPUnit\Framework\TestCase;
use jove4015\EpubToText\Exceptions\CouldNotExtractText;
use jove4015\EpubToText\Exceptions\EpubNotFound;
use jove4015\EpubToText\Epub;

#TODO - add in proper test files for epub

class EpubToTextTest extends TestCase
{
    protected $dummyEpub = __DIR__.'/testfiles/dummy.epub';
    protected $dummyEpubText = <<<EOF
Your Reading System does not support canvas.  Trees

        Classification      Morphology        

  Classification

    Your Reading System does not support canvas.  A tree is a plant form that occurs in many different orders and families of plants. Most  species of trees today are flowering plants (angiosperms) and conifers. Trees show a  variety of growth forms, leaf type and shape, bark characteristics and reproductive  organs. For the listing of examples of well-known trees and how they are classified, see  List of tree genera.

  The tree form has evolved separately in unrelated classes of plants, in response to  similar environmental challenges, making it a classic example of parallel evolution.  With an estimate of 100,000 tree species, the number of tree species worldwide might  total 25 percent of all living plant species. The majority of tree species grow in  tropical regions of the world and many of these areas have not been surveyed yet by  botanists, making species diversity and ranges poorly understood. The earliest  tree-like organisms were tree ferns, horsetails and lycophytes, which grew in forests in  the Carboniferous period, however these plants were not trees, since  they lacked woody tissue. Trees evolved in the Triassic period, with conifers, ginkgos,  cycads and other gymnosperms appeared producing woody tissue, and were subsequently  followed by tree-form flowering plants in the Cretaceous period.

  A small group of trees growing together is called a grove or copse, and a landscape  covered by a dense growth of trees is called a forest. Several biotopes are defined  largely by the trees that inhabit them; examples are rainforest and taiga (see  ecozones). A landscape of trees scattered or spaced across grassland (usually grazed or  burned over periodically) is called a savanna. A forest of great age is called old  growth forest or ancient woodland (in the UK). A young tree is called a sapling.

  

    Morphology

    Your Reading System does not support canvas.  The parts of a tree are the roots, trunk(s), branches, twigs and leaves. Tree stems  consist mainly of support and transport tissues (xylem and phloem). Wood consists of  xylem cells, and bark is made of phloem and other tissues external to the vascular  cambium. Trees may be grouped into exogenous and endogenous trees according to the  way in which their stem diameter increases. Exogenous trees, which comprise the  great majority of trees (all conifers, and almost all broadleaf trees), grow by the  addition of new wood outwards, immediately under the bark. Endogenous trees, mainly  in the monocotyledons (e.g., aloes and dragon trees), grow by addition of new  material as discrete bundles within the existing trunk tissue.

  Trees can be identified to genus or species by a combination of the tree's shape, and  the characteristics of its bark, leaves, flowers, and fruit. The leaves may be  either deciduous or evergreen.

  As an exogenous tree grows, it creates growth rings as new wood is laid down  concentrically over the old wood. In species growing in areas with seasonal climate  changes, wood growth produced at different times of the year may be visible as  alternating light and dark, or soft and hard, rings of wood. In temperate  climates, and tropical climates with a single wet-dry season alternation, the growth  rings are annual, each pair of light and dark rings being one year of growth; these  are known as annual rings. In areas with two wet and dry seasons each year, there  may be two pairs of light and dark rings each year; and in some (mainly semi-desert  regions with irregular rainfall), there may be a new growth ring with each  rainfall. In tropical rainforest regions, with constant year-round climate,  growth is continuous and the growth rings are not visible nor is there a change in  the wood texture. In species with annual rings, these rings can be counted to  determine the age of the tree, and used to date cores or even wood taken from trees  in the past, a practice known as the science of dendrochronology. Very few tropical  trees can be accurately dated in this manner. Age determination in this manner is  also impossible in endogenous trees.

  The roots of a tree are generally embedded in earth, providing anchorage for the  above-ground biomass and absorbing water and nutrients from the soil. However, while  ground nutrients are essential to a tree's growth the majority of its biomass – over  90 percent – comes from carbon dioxide absorbed from the atmosphere (see  photosynthesis). Above ground, the trunk gives height to the leaf-bearing  branches, aiding in competition with other plant species for sunlight. In many  trees, the arrangement of the branches optimizes exposure of the leaves to  sunlight.

  Not all trees have all the plant organs or parts mentioned above. For example, the  saguaro cactus of North America has no functional leaves. A plant form that is  similar to a tree, but generally having smaller, multiple trunks and/or branches  that arise near the ground, is called a shrub. However, no precise differentiation  between shrubs and trees is possible. Given their small size, bonsai plants would  not technically be "trees", but one should not confuse reference to the form of a  species with the size or shape of individual specimens. A spruce seedling does not  fit the definition of a tree, but all spruces are trees.
EOF;

    /** @test */
    public function it_can_extract_text_from_a_Epub()
    {
        $text = (new Epub())
            ->setEpub($this->dummyEpub)
            ->text();

        $this->assertSame($this->dummyEpubText, $text);
    }

    /** @test */
    public function it_provides_a_static_method_to_extract_text()
    {
        $this->assertSame($this->dummyEpubText, Epub::getText($this->dummyEpub));
    }

    /** @test */
    public function it_can_hande_paths_with_spaces()
    {
        $EpubPath = __DIR__.'/testfiles/dummy with spaces in its name.epub';

        $this->assertSame($this->dummyEpubText, Epub::getText($EpubPath));
    }

    /** @test */
    public function it_can_hande_paths_with_single_quotes()
    {
        $EpubPath = __DIR__.'/testfiles/dummy\'s_file.epub';

        $this->assertSame($this->dummyEpubText, Epub::getText($EpubPath));
    }

    /** @test */
    public function it_will_throw_an_exception_when_the_Epub_is_not_found()
    {
        $this->expectException(EpubNotFound::class);

        (new Epub())
            ->setEpub('/no/Epub/here/dummy.epub')
            ->text();
    }

    /** @test */
    public function it_will_throw_an_exception_when_the_binary_is_not_found()
    {
        $this->expectException(CouldNotExtractText::class);

        (new Epub('/there/is/no/place/like/home/Epubtotext'))
            ->setEpub($this->dummyEpub)
            ->text();
    }
}
