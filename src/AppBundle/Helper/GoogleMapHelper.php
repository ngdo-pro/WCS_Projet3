<?php
/**
 * Created by PhpStorm.
 * User: damien
 * Date: 30/01/17
 * Time: 14:29
 */

namespace AppBundle\Helper;

use Ivory\GoogleMap\Helper\MapHelper;
use Ivory\GoogleMap\Map;


class GoogleMapHelper extends MapHelper
{

    public function renderJsContainer(Map $map)
    {
        $result = parent::renderJsContainer($map);
        $output[] = "
        var styles =
    [
    {
    \"elementType\": \"geometry\",
    \"stylers\": [
    {
    \"color\": \"#e6e4e1\"
    }
    ]
    },
    {
    \"elementType\": \"labels.icon\",
    \"stylers\": [
    {
    \"visibility\": \"off\"
    }
    ]
    },
    {
    \"elementType\": \"labels.text.fill\",
    \"stylers\": [
    {
    \"color\": \"#616161\"
    }
    ]
    },
    {
    \"elementType\": \"labels.text.stroke\",
    \"stylers\": [
    {
    \"color\": \"#f5f5f5\"
    }
    ]
    },
    {
    \"featureType\": \"administrative.land_parcel\",
    \"elementType\": \"labels.text.fill\",
    \"stylers\": [
    {
    \"color\": \"#bdbdbd\"
    }
    ]
    }," .
    /*{
    \"featureType\": \"poi\",
    \"elementType\": \"geometry\",
    \"stylers\": [
    {
    \"color\": \"#eeeeee\"
    }
    ]
    },
    {
    \"featureType\": \"poi\",
    \"elementType\": \"labels.text.fill\",
    \"stylers\": [
    {
    \"color\": \"#757575\"
    }
    ]
    },*/
    "{
    \"featureType\": \"poi.park\",
    \"elementType\": \"geometry\",
    \"stylers\": [
    {
    \"color\": \"#b6d7db\"
    }
    ]
    },
    {
    \"featureType\": \"poi.park\",
    \"elementType\": \"labels.text.fill\",
    \"stylers\": [
    {
    \"color\": \"#9e9e9e\"
    }
    ]
    },
    {
    \"featureType\": \"road\",
    \"elementType\": \"geometry\",
    \"stylers\": [
    {
    \"color\": \"#ffffff\"
    }
    ]
    },
    {
    \"featureType\": \"road.arterial\",
    \"elementType\": \"labels.text.fill\",
    \"stylers\": [
    {
    \"color\": \"#b4b4b4\"
    }
    ]
    },
    {
    \"featureType\": \"road.highway\",
    \"elementType\": \"geometry\",
    \"stylers\": [
    {
    \"color\": \"#c4c4c4\"
    }
    ]
    },
    {
    \"featureType\": \"road.highway\",
    \"elementType\": \"labels.text.fill\",
    \"stylers\": [
    {
    \"color\": \"#616161\"
    }
    ]
    },
    {
    \"featureType\": \"road.local\",
    \"elementType\": \"labels.text.fill\",
    \"stylers\": [
    {
    \"color\": \"#9e9e9e\"
    }
    ]
    },
    {
    \"featureType\": \"transit.line\",
    \"elementType\": \"geometry\",
    \"stylers\": [
    {
    \"color\": \"#e5e5e5\"
    }
    ]
    },
    {
    \"featureType\": \"transit.station\",
    \"elementType\": \"geometry\",
    \"stylers\": [
    {
    \"color\": \"#eeeeee\"
    }
    ]
    },
    {
    \"featureType\": \"water\",
    \"elementType\": \"geometry\",
    \"stylers\": [
    {
    \"color\": \"#73b2bd\"
    }
    ]
    },
    {
    \"featureType\": \"water\",
    \"elementType\": \"labels.text.fill\",
    \"stylers\": [
    {
    \"color\": \"#9e9e9e\"
    }
    ]
    }
    ];
        ";
        $output[] = "var styledMap = new google.maps.StyledMapType(styles, {name: \"Gmap stylée\"});";
        $output[] = sprintf(
            '%s.map.mapTypes.set(\'map_style\', styledMap);',
            $this->getJsContainerName($map)
        );
        $output[] = sprintf(
            '%s.map.setMapTypeId(\'map_style\');',
            $this->getJsContainerName($map)
        ) ;
        $result .= implode ("",$output);
        return $result;
    }



}