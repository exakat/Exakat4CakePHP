<?php
/*
 * Copyright 2012-2018 Damien Seguy – Exakat SAS <contact(at)exakat.io>
 * This file is part of Exakat.
 *
 * Exakat is free software: you can redistribute it and/or modify
 * it under the terms of the GNU Affero General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Exakat is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Affero General Public License for more details.
 *
 * You should have received a copy of the GNU Affero General Public License
 * along with Exakat.  If not, see <http://www.gnu.org/licenses/>.
 *
 * The latest code can be found at <http://exakat.io/>.
 *
*/

namespace Exakat\Analyzer\Cakephp;

use Exakat\Analyzer\Analyzer;
use Exakat\Analyzer\Common\MethodcallUsage;

class Cake32DeprecatedMethods extends MethodcallUsage {
    public function analyze() {
        $this->calledMethods = array('error', // Shell
                                     'type',  // Cake\Database\Expression\QueryExpression
                                     '_calculateTypeMap', //Cake\ORM\ResultSet::_calculateTypeMap() is now unused and deprecated.
                                     '_castValues', // Cake\ORM\ResultSet::_castValues() is now unused and deprecated.
                                     );
     
        parent::analyze();
    }
}

?>
