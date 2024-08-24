<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Contact;
use Mail;

class ContactController extends Controller
{

    public function index()
    {
        $contacts = Contact::all();
        return view('backend.contact.index',compact('contacts'));
    }
    // Create Contact Form
    public function createForm(Request $request) {
        return view('frontend.pages.contact');
      }

      // Store Contact Form data
      public function ContactUsForm(Request $request) {
          // Form validation
          $this->validate($request, [
              'name' => 'required',
              'email' => 'required|email',
              'phone' => 'required|regex:/^([0-9\s\-\+\(\)]*)$/|min:10',
              'subject'=>'required',
              'message' => 'required'
           ]);
          //  Store data in database
          Contact::create($request->all());
          //  Send mail to admin
          \Mail::send('emails.contact.contact', array(
              'name' => $request->get('name'),
              'email' => $request->get('email'),
              'phone' => $request->get('phone'),
              'subject' => $request->get('subject'),
              'user_query' => $request->get('message'),
          ), function($message) use ($request){
              $message->from($request->email);
              $message->to('phandinhhungvp2001@gmail.com', 'Admin')->subject($request->get('subject'));
          });
          return back()->with('success', __('frontend.We have received your message and would like to thank you for writing to us.'));
      }

      public function destroy($id)
      {
          $contact = Contact::find($id);
          $contact->delete();
          toastr()->success(__('frontend.Contact deleted successfully.'));
          return redirect()->route('admin.contact.index');
      }
}
