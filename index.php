

<?php
   /**
    * I have create this with static data like srt and mp4 video files.
    * This script will create one video (mp4 format) file with multiple subtitles and diff. languages
    */

   /* i.e : test.mp4 i have already one video file without any sub title */
   $videoFile = "D:\\videoplayback.mp4"; 
   /* i.e : en.srt it is srt file for english langauage */
   $en_srtFile = "D:\\en.srt";
   /* i.e : gu.srt it is srt file for gujarati langauage */
   $gu_srtFile = "D:\\gu.srt";

   // This array used for add ffmpeg parameters.
   $en_commands = array(
        '-i '.$videoFile,
        '-i '.$en_srtFile,
        '-map 0',
        '-map 1',
        '-c copy',
        '-c:s mov_text',
        'D:\\en.mp4'
    );

    $en_str='C:\\FFmpeg\\bin\\ffmpeg.exe '.implode(' ',$en_commands);

    /**
     * This command execute as input three file 
     *      1) video file 
     *      2) multiple srt file
     *  Output :
     *      Generate new video file with multiple subtitles with different language.
     */
    
    echo shell_exec($en_str);
    echo "en.mp4 file created.<br/>";
    exit;

    $gu_commands = array(
        '-i '.$videoFile,
        '-i '.$gu_srtFile,
        '-map 0',
        '-map 1',
        '-c copy',
        '-c:s mov_text',
        'D:\\gu.mp4'
    );

    $gu_str='C:\\FFmpeg\\bin\\ffmpeg.exe '.implode(' ',$gu_commands);

    /**
     * This command execute as input three file 
     *      1) video file 
     *      2) multiple srt file
     *  Output :
     *      Generate new video file with multiple subtitles with different language.
     */
    
    echo shell_exec($gu_str);
    echo "gu.mp4 file created.<br/>";
    exit;

?>


