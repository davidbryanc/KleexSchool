<?php

namespace App\Http\Controllers;

use App\Models\Grade;
use App\Models\Period;
use App\Models\Student;
use App\Models\Subject;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PrincipalController extends Controller
{
    public function index(){
        $user = auth() -> user();

        return view('principal', compact('user'));
    }

    public function tambahData(Request $request)
    {
        $jenis = $request->get('jenis');
        $nama = $request->get('nama');
        $alamat = $request->get('alamat');
        $tglLahir = $request->get('tglLahir');
        $sex = $request->get('sex');
        $noTelp = $request->get('noTelp');
        $kelas = $request->get('kelas');
        $username = $request->get('username');
        $password = $request->get('password');

        $user = new User();
        $user->username = $username;
        $user->password = Hash::make("dhawiohawodhaoh");
        $user->role = $jenis;
        $user->save();     
        
        if($jenis == "Student"){
            $student = new Student();
            $student->user_id = User::where('username', $username)->first()->id; 
            $student->name = $nama;
            $student->address = $alamat;
            $student->birth_date = $tglLahir;
            $student->phone_number = $noTelp;
            $student->gender = $sex;
            $student->class = $kelas;
            $student->save();

            //Isi Grades
            $periods = Period::all();
            $subjects = Subject::all();
            foreach($periods as $period){
                foreach($subjects as $subject){
                    $grade = new Grade();
                    $grade->student_id = Student::where('name', $nama)->first()->id; 
                    $grade->subject_id = $subject->id;
                    $grade->period_id = $period->id;
                    $grade->mid_score = 0;
                    $grade->end_score = 0;
                    $grade->final_score = 0;
                    $grade->nisbi = 'E';
                    $grade->save();
                }
            }

        }else if($jenis == "Teacher"){
            $teacher = new Teacher();
            $teacher->user_id = User::where('username', $username)->first()->id; 
            $teacher->name = $nama;
            $teacher->address = $alamat;
            $teacher->birth_date = $tglLahir;
            $teacher->phone_number = $noTelp;
            $teacher->gender = $sex;
            $teacher->class = $kelas;
            $teacher->save();
        }

        // create stegano
        $file = 'images/profile.jpg';
        $message = $password;   
        $this->steganize($file, $message, $username);

        return response()->json(array(
            'message' => "success",        
        ), 200);
    }

    function steganize($file, $message, $username) {
        // Encode the message into a binary string.
        $binaryMessage = '';
        for ($i = 0; $i < mb_strlen($message); ++$i) {
            $character = ord($message[$i]);
            $binaryMessage .= str_pad(decbin($character), 8, '0', STR_PAD_LEFT);
        }
        
        // Inject the 'end of text' character into the string.
        $binaryMessage .= '00000011';
        
        // Load the image into memory.
        $img = imagecreatefromjpeg($file);
        
        // Get image dimensions.
        $width = imagesx($img);
        $height = imagesy($img);
        
        $messagePosition = 0;
        
        for ($y = 0; $y < $height; $y++) {
            for ($x = 0; $x < $width; $x++) {
        
            if (!isset($binaryMessage[$messagePosition])) {
                // No need to keep processing beyond the end of the message.
                break 2;
            }
        
            // Extract the colour.
            $rgb = imagecolorat($img, $x, $y);
            $colors = imagecolorsforindex($img, $rgb);
        
            $red = $colors['red'];
            $green = $colors['green'];
            $blue = $colors['blue'];
            $alpha = $colors['alpha'];
        
            // Convert the blue to binary.
            $binaryBlue = str_pad(decbin($blue), 8, '0', STR_PAD_LEFT);
        
            // Replace the final bit of the blue colour with our message.
            $binaryBlue[strlen($binaryBlue) - 1] = $binaryMessage[$messagePosition];
            $newBlue = bindec($binaryBlue);
        
            // Inject that new colour back into the image.
            $newColor = imagecolorallocatealpha($img, $red, $green, $newBlue, $alpha);
            imagesetpixel($img, $x, $y, $newColor);
        
            // Advance message position.
            $messagePosition++;
            }
        }
        
        // Save the image to a file.
        $newImage = 'images/p'.$username.'.png';
        imagepng($img, $newImage, 9);
        
        // Destroy the image handler.
        imagedestroy($img);
    }
}