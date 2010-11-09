<?php defined('BASEPATH') or exit('No direct script access allowed');

/**
 * Downloads
 *
 * Allows files to be simply downloaded
 *
 * @package		MojoMotor
 * @subpackage	Addons
 * @author		Tiziano
 */
class Downloads
{
	public $mojo;
	public $display_name  = 'Downloads';
	public $addon_version = '1.0';

	// --------------------------------------------------------------------

	/**
	 * Constructor
	 *
	 * @access	public
	 * @return	void
	 */
	function __construct()
	{		
		$this->mojo =& get_instance();
	}

	// --------------------------------------------------------------------

	public function download($data = array())
	{
	  	$filename 		= $this->getParameter($data,'filename');
	  	$filename_desc	= $this->getParameter($data,'filename_desc');
	  	
	  	if( $filename_desc == FALSE)
	  	{
	  		$filename_desc = $filename;
	  	}
		
		$description 	= $this->getParameter($data,'description');
		$li_class       = $this->getParameter($data,'li_class');
			
		if ($li_class == FALSE) 
		{
			$li_cass = "default"; 
		}	
		$desc_tag       = $this->getParameter($data,'desc_tag');
		$desc_class     = $this->getParameter($data,'desc_class');
		
        $result = '<li class="'.$li_class.'"><a href="'.site_url('addons/downloads/doDownload').'/'.$filename.'" >'.$filename_desc.'</a>';
		
		if( $description != FALSE && $desc_tag != FALSE)
		{
			$desc  = '<'.$desc_tag.' class="'.$desc_class.'">'.$description.'</'.$desc_tag.'>';
			$result = $result.$desc;
		}
		
		$result = $result.'</li>';

        return $result;
	}
        // the download function
    public function doDownload($filename = "test.pdf")
    {
        $this->mojo->load->helper('download');
			
	    $data =  (getcwd().'/downloads/'.$filename); // Read the file's contents
        if ( $data != FALSE)
        {
	         force_download($filename, $data);
        }
    }
	
	private function getParameter($data,$parameter="")
	{
		if (isset( $data['parameters'][$parameter])) 
		{
			return trim($data['parameters'][$parameter]);			
		}
		else
		{
			return FALSE;
		}
	}
	
	// --------------------------------------------------------------------
}

/* End of file show.php */
/* Location: system/mojomotor/third_party/downloads/libraries/downloads.php */