

<?php
ini_set('max_execution_time', 3000);
   /**
    * I have create this with static data like srt and mp4 video files.
    * This script will create one video (mp4 format) file with multiple subtitles and diff. languages
    */
   
   /* i.e : test.mp4 i have already one video file without any sub title */
   $videoFile = "D:\\xampp\\htdocs\\video-qbix\\videos\\sample\\sample.mp4"; 
   $outfile="D:\\xampp\\htdocs\\video-qbix\\videos\\sample\\out.mp4";

   $hindi_audioFile = "D:\\xampp\\htdocs\\video-qbix\\videos\\sample\\hi.mp3";
   $hi_srtFile = "D:\\xampp\\htdocs\\video-qbix\\videos\\sample\\hi.srt";
   $outfile_hindi="D:\\xampp\\htdocs\\video-qbix\\videos\\sample\\hi.mp4";

   $english_audioFile = "D:\\xampp\\htdocs\\video-qbix\\videos\\sample\\en.mp3";
   $en_srtFile = "D:\\xampp\\htdocs\\video-qbix\\videos\\sample\\en.srt";
   $outfile_english="D:\\xampp\\htdocs\\video-qbix\\videos\\sample\\en.mp4";

   $hi_commands = array(
    '-i '.$videoFile,
    '-i '.$hindi_audioFile,
    '-i '.$hi_srtFile,
    '-map 0',
    '-map 1',
    '-c copy',
    '-c:s mov_text',
    '-c:v copy',
    '-c:a aac',
    '-strict',
    'experimental',
    $outfile,
    );



    $hi_str='C:\\FFmpeg\\bin\\ffmpeg.exe '.implode(' ',$hi_commands); 
    echo shell_exec($hi_str);
   
    $hi_commands1 = array(
        '-i '.$outfile,
        '-vf drawtext="fontfile=/path/to/font.ttf:',
        'text=\'QBIX\': fontcolor=white: fontsize=24: box=1: boxcolor=black@0.5:',
        'boxborderw=5: x=(w-text_w)/2: y=(h-text_h)/2"',
        '-codec:a copy',
        $outfile_hindi,
        );
    
    $hi_str='C:\\FFmpeg\\bin\\ffmpeg.exe '.implode(' ',$hi_commands1); 
  
    echo shell_exec($hi_str);

    echo "hi.mp4 file created.<br/>";
    
   
    $en_commands = array(
        '-i '.$videoFile,
        '-i '.$english_audioFile,
        '-i '.$en_srtFile,
         '-map 0',
        '-map 1',
        '-c copy',
        '-c:s mov_text',
        '-c:v copy',
        '-c:a aac',
        '-strict',
        'experimental',
        $outfile,
        );

        
    $en_str='C:\\FFmpeg\\bin\\ffmpeg.exe '.implode(' ',$en_commands);
   
    echo shell_exec($en_str);
    echo "en.mp4 file created.<br/>";

    $en_commands1 = array(
        '-i '.$outfile,
        '-vf drawtext="fontfile=/path/to/font.ttf:',
        'text=\'QBIX\': fontcolor=white: fontsize=24: box=1: boxcolor=black@0.5:',
        'boxborderw=5: x=(w-text_w)/2: y=(h-text_h)/2"',
        '-codec:a copy',
        $outfile_english,
        );
    
    $en_str='C:\\FFmpeg\\bin\\ffmpeg.exe '.implode(' ',$en_commands1); 
 
    echo shell_exec($en_str);

    exit;   

?>


