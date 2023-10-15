<?php
/**
 * @title            QR Code
 * @desc             Compatible to vCard 4.0 or higher.
 *
 * @author           Pierre-Henry Soria <ph7software@gmail.com>
 * @copyright        (c) 2012-2018, Pierre-Henry Soria. All Rights Reserved.
 * @license          GNU General Public License <http://www.gnu.org/licenses/gpl.html>
 * @version          1.2
 */

class vCard
{
    

    private $sData;

    /**
     * Constructor.
     */
    public function __construct()
    {
        $this->sData = 'BEGIN:VCARD'."\n";
        $this->sData .= 'VERSION:4.0'."\n";
    }

    /**
     * The name of the person.
     *
     * @param string $sName
     *
     * @return self
     */
    public function name($sName)
    {
        $this->sData .= 'N:'.$sName."\n";
        return $this;
    }


    /**
     * @param string $sAddress
     *
     * @return self
     */
    public function address($sAddress, $sCity, $sPostcode, $sState)
    {
        $this->sData .= 'ADR:;;'.$sAddress.';';
        $this->sData .= $sCity.';'.$sPostcode.';'.$sState."\n";
        return $this;
    }

    /**
     * @param string $sNickname
     *
     * @return self
     */
    public function nickName($sNickname)
    {
        $this->sData .= 'NICKNAME:'.$sNickname."\n";
        return $this;
    }

    /**
     * @param string $sMail
     *
     * @return self
     */
    public function email($sMail)
    {
        $this->sData .= 'EMAIL;TYPE=PREF,INTERNET:'.$sMail."\n";
        return $this;
    }

    /**
     * @param string $sVal
     *
     * @return self
     */
    public function workPhone($sVal)
    {
        $this->sData .= 'TEL;;TYPE=work:'.$sVal."\n";
        return $this;
    }

    /**
     * @param string $sVal
     *
     * @return self
     */
    public function homePhone($sVal)
    {
        $this->sData .= 'TEL;;TYPE=home:'.$sVal."\n";
        return $this;
    }
    
    /**
     * @param string $sVal
     *
     * @return self
     */
    public function cellPhone($sVal)
    {
        $this->sData .= 'TEL:'.$sVal."\n";
        return $this;
    }

    /**
     * @param string $sUrl
     *
     * @return self
     */
    public function url($sUrl)
    {
        $sUrl = (substr($sUrl, 0, 4) != 'http') ? 'http://'.$sUrl : $sUrl;
        $this->sData .= 'URL:'.$sUrl."\n";
        return $this;
    }

    /**
     * A list of "tags" that can be used to describe the object represented by this vCard.
     *
     * @param string $sCategories
     *
     * @return self
     */
    public function categories($sCategories)
    {
        $this->sData .= 'CATEGORIES:'.$sCategories."\n";
        return $this;
    }

    /**
     * Photo (avatar).
     *
     * @param string $sImgUrl URL of the image.
     *
     * @return self
     *
     * @throws InvalidArgumentException If the image format is invalid.
     */
    public function photo($sImgUrl)
    {
        if($sImgUrl != NULL){
        
        $bIsImgExt = strtolower(substr(strrchr($sImgUrl, '.'), 1)); // Get the file extension.

        if ($bIsImgExt == 'jpeg' || $bIsImgExt == 'jpg' || $bIsImgExt == 'png' || $bIsImgExt == 'gif') {
            $sExt = strtoupper($bIsImgExt);
        } else {
            throw new InvalidArgumentException('Invalid format Image!');
        }

        $this->sData .= 'PHOTO;VALUE=URL;TYPE='.$sExt.':'.$sImgUrl."\n";

        return $this;
        }
    }

    /**
     * The role, occupation, or business category of the vCard object within an organization.
     *
     * @param string $sRole e.g., Executive
     *
     * @return self
     */
    public function role($sRole)
    {
        $this->sData .= 'ROLE:'.$sRole."\n";
        return $this;
    }

    /**
     * The organization / company.
     *
     * The name and optionally the unit(s) of the organization
     * associated with the vCard object. This property is based on the X.520 Organization Name
     * attribute and the X.520 Organization Unit attribute.
     *
     * @param string $sOrg e.g., Google;GMail Team;Spam Detection Squad
     *
     * @return self
     */
    public function organization($sOrg)
    {
        $this->sData .= 'ORG:'.$sOrg."\n";
        return $this;
    }

    /**
     * The supplemental information or a comment that is associated with the vCard.
     *
     * @param string $sText
     *
     * @return self
     */
    public function note($sText)
    {
        $this->sData .= 'NOTE:'.$sText."\n";
        return $this;
    }

    /**
     *
     * @return self
     */
    public function create()
    {
        $this->sData .= 'END:VCARD';
        return $this;
    }

    /**
     * Get the vCard data.
     */
    public function get()
    {
        return $this->sData;
    }
}