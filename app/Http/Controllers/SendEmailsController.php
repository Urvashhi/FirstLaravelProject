<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
 
use Mail;
 
use PDF;
 
 use DB;

class SendEmailsController extends Controller
{
  
    public function sendmail(Request $request)
    {
/*
        $data["email"]="urvashi2705@gmail.com";
        $data["client_name"]="ashi";
        $data["subject"]="xyz";

        $pdf = PDF::loadView('Books.test', $data);


        try{
            Mail::send('Books.test', $data, function($message)use($data,$pdf) {
            $message->to($data["email"], $data["client_name"])
            ->subject($data["subject"])
            ->attachData($pdf->output(), "invoice.pdf");
            });
        }catch(JWTException $exception){
            $this->serverstatuscode = "0";
            $this->serverstatusdes = $exception->getMessage();
        }
        if (Mail::failures()) {
             $this->statusdesc  =   "Error sending mail";
             $this->statuscode  =   "0";

        }else{

           $this->statusdesc  =   "Message sent Succesfully";
           $this->statuscode  =   "1";
        }
        return response()->json(compact('this'));
 }*/
 
            $mpdf = new \Mpdf\Mpdf();
        $data["email"]="urvashi2705@gmail.com";
        $data["client_name"]="ashi";
        $data["subject"]="xyz";
        
        // Write some HTML code:
         /*$books=DB::table('issue_book')
               ->join('books', 'issue_book.book_id', '=', 'books.id')
               ->where('issue_book.user_id', $userId)
               ->get();*/
               $userId=auth()->user()->id;
               $p=DB::table('issue_book')
               ->join('books', 'issue_book.book_id', '=', 'books.id')
               ->where('issue_book.user_id', $userId)
               ->get();
    //dd($p);
        $book= view()->share('p', $p);
      //$image= asset('upload/'.$bk->image) ;
        // $pdf= PDF::loadview('check_pdf');
        $output = '
     <h3 align="center">Customer Data</h3>
     <table width="100%" style="border-collapse: collapse; border: 0px;">
      <tr>
    <th style="border: 1px solid; padding:12px;" width="30%">Image</th>
    <th style="border: 1px solid; padding:12px;" width="30%">Title</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Author</th>
    <th style="border: 1px solid; padding:12px;" width="15%">Category</th>
    <th style="border: 1px solid; padding:12px;" width="20%">Status</th>
	 <th style="border: 1px solid; padding:12px;" width="20%">IssueDate</th>
	  <th style="border: 1px solid; padding:12px;" width="20%">Return Date</th>
   </tr>
     ';
        foreach ($book as $bk) {
            $output .= '
      <tr>
		
	   <td style="border: 1px solid; padding:12px;">'.$bk->image.'</td>
       <td style="border: 1px solid; padding:12px;">'.$bk->title.'</td>
       <td style="border: 1px solid; padding:12px;">'.$bk->author.'</td>
       <td style="border: 1px solid; padding:12px;">'.$bk->category.'</td>
       <td style="border: 1px solid; padding:12px;">'.$bk->approve.'</td>
       <td style="border: 1px solid; padding:12px;">'.$bk->issue_date.'</td>
	   <td style="border: 1px solid; padding:12px;">'.$bk->return_date.'</td>
      </tr>
      ';
        }
        $output .= '</table>';

        $mpdf->WriteHTML("$output");
       
        // Output a PDF file directly to the browser
        //$mpdf->Output('book.pdf', 'D');

         Mail::send('Books.test', $data, function ($message) use ($data, $mpdf) {
            $message->to($data["email"], $data["client_name"])
            ->subject($data["subject"])
            ->attachData($mpdf->output('invoice.pdf', 'S'), "invoice.pdf");
         });
    }
}
