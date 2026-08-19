<?php

namespace Modules\Inventory\Enums;

enum UnitType:string {
   case QUANTITY = 'quantity';
    case WEIGHT = 'weight';
    case VOLUME = 'volume';
    case LENGTH = 'length';
    case AREA = 'area';  
}