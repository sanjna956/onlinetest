<?php

/**
 * Generate thumbnail to fit div width and height
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program. If not, see <http://www.gnu.org/licenses/>.
 */

Class Thumbnail {
	
	public function generateThumbnail ($sourceimagepath,$thumbnailpath,$div_width,$div_height) {
		
		$source_img = $this->readImage($sourceimagepath);
		if (!$source_img) {
			
			return false; // Unable to read image so return false
		}
		
		$orig_w = imagesx($source_img);
		$orig_h = imagesy($source_img);
		
		$crop_w = $div_width;
		$crop_h = $div_height;
		
		/*if ($div_width >= $orig_w && $div_height >= $orig_h) { // Image already has dimension to fit with in DIV
			
			$thumb_img = $source_img;   /// Return original image  
			
		} else {
		
		
			$ratio_orig  = $orig_w/$orig_h; // width to height ratio of original image
			$ratio_thumb = $div_width/$div_height; //width to height ratio of thumbnail image
			
			if ($ratio_orig > $ratio_thumb ) {
		
					$crop_w = $div_width;
					$crop_h = round($div_height/$ratio_orig);
						
				}else{
					
					$crop_h = $div_height;
					$crop_w = round($div_height*$ratio_orig);
					
				}
		
			
		}*/
		$thumb_img = imagecreatetruecolor($crop_w, $crop_h);
		
			$result = imagecopyresampled($thumb_img, $source_img, 0, 0, 0, 0, $crop_w, $crop_h, $orig_w, $orig_h);
		
			if ($result === false) {
				imagedestroy($thumb_img);
				return false;
			}
		$result = $this->saveImage($thumbnailpath, $thumb_img, 100);
		imagedestroy($thumb_img);
		
		if($result) {
			
			return $thumbnailpath;
		}
		else {
			
			return false;
		}
		
		
	}
	
	private function saveImage($imagepath, $image, $quality) {
	
		$ext = strtolower(pathinfo($imagepath, PATHINFO_EXTENSION));
		switch ($ext) {
			case 'jpg': case 'jpeg':
				return imagejpeg($image, $imagepath, $quality);
			case 'gif':
				return imagegif($image, $imagepath);
			case 'png':
				return imagepng($image, $imagepath, 9);
			default:
				return false;
		}
	}
	
	private function readImage ($imagepath) {
		
		$ext = strtolower(pathinfo($imagepath, PATHINFO_EXTENSION));
		switch ($ext) {
			case 'jpg': case 'jpeg':
				return @imagecreatefromjpeg($imagepath);
			case 'gif':
				return @imagecreatefromgif($imagepath);
			case 'png':
				return @imagecreatefrompng($imagepath);
			default:
				return false;
		}
	}
	
}