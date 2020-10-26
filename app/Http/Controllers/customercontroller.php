<?php
namespace App\Http\Controllers;
use App\Models\CustomerInsert;
use App\Models\ticketinsert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;


class customercontroller extends Controller
{

    public function insertform()
    {
        return view('login');
    }

    public function insert(Request $request)
    {
        $rules = [
            'cname' => 'required|string|min:3|max:255',
            'mail' => 'required|email|min:3|max:255',
            'password' => 'required|string|min:3|max:255',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect('signup')
                ->withInput()
                ->withErrors($validator);
        } else
            {
                echo "<style>
            p {
            text-align: center;
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }</style>";
                $data = $request->input();
                if (DB::table('customer')->select('*')->where('email', $data['mail'])->first()) {
                    echo "<p>User already Exists</p><br>";
                    echo '<p><a href = "customerlogin">Click Here</a> to go back to login page.</p>';

                } else {
                    $customer = new CustomerInsert;
                    $customer->name = $data['cname'];
                    $customer->email = $data['mail'];
                    $customer->password = $data['password'];
                    $customer->save();
                    echo "<p>Signed up Successfully.</p><br/>";
                    echo '<p><a href = "customerlogin">Click Here</a> to go back to login page.</p>';
                }
            }
        }

        public function authenticate(Request $request)
        {
            echo "<style>
            p {
            text-align: center;
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }</style>";
            $rules = [
                'mail' => 'required|email|min:3|max:255',
                'password' => 'required|string|min:3|max:255',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('customerlogin')
                    ->withInput()
                    ->withErrors($validator);
            } else {
                $data = $request->input();
                if ($customer=DB::table('customer')->where('email', '=', $data['mail'])->first()) {
                    $request->session()->put('email', $data['mail']);
                    if ($customer->password == $data['password']) {
                        return view('customer');
                    } else {
                        echo '<p>password is incorrect. Please check and enter again <a href="customerlogin">here</a></p>';
                    }
                } else {
                    echo '<p>User does not exist or Email ID is wrong. Please Create an account  <a href="/signup">here</a> or try logging in <a href="/customerlogin">here</a> </p>';
                }
            }
        }

        public function ticketnew(Request $request)
        {
            echo "<style>
            p {
            text-align: center;
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }</style>";
            $rules = [
                'category'=>'required',
                'categoryselect'=>'required',
                'issue'=>'max:255',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect('newticket')
                    ->withInput()
                    ->withErrors($validator);
            } else {
                $email = $request->session()->get('email');
                if ($email == NULL) {
                    echo "<p>No User Found. Please Login <a href='customerlogin'>here</a> again and try accessing this.</p>";
                } else {
                    $data = $request->input();
                    if (DB::table('employee')->where('availability', '=', 'free')->first()) {
                        $cust = DB::table('customer')->where('email', '=', $email)->first();
                        $ticket = new ticketinsert();
                        $ticket->customer_id = $cust->id;
                        $info = "Issue Category:" . $data['category'] . "\r\n Issue:" . $data['categoryselect'] . "\r\nIssue Description:" . $data['issue'];
                        $ticket->Information = nl2br($info, false);
                        $ticket->status = "OPEN";
                        $emp = DB::table('employee')->where('availability', '=', 'free')->first();
                        $idd = $emp->id;
                        DB::update('update employee set availability="occupied" where id=?', [$idd]);
                        $ticket->emp_id = $idd;
                        $ticket->save();
                        echo "<p>Ticket Created Successfully</p><br>";
                        echo '<a href="/customer">click here</a> to go to your home page</p>';
                    } else {
                        echo "<p>No employee is free Right now, please Try again after some time<br>";
                        echo '<a href="/customer">click here</a> to go to your home page</p>';
                    }
                }

            }
        }

    public function showtickets(Request $request)
    {
        echo "<style>
            p {
            text-align: center;
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }</style>";
        $email = $request->session()->get('email');
        if ($email == NULL) {
            echo "No User Found. Please Login <a href='login'>here</a> again and try accessing this.";
        } else {
            if ($cust = DB::table('customer')->where('email', '=', $email)->first()) {
                if (DB::table('ticket')->where('customer_id', '=', $cust->id)->first())
                {
                    $tickets = DB::table('ticket')->where('customer_id', '=', $cust->id)->get();
                    echo '<style>
                                    table, th, td {
                                    align-content: center;
                                    border: 1px solid black;
                                     border-collapse: collapse;
                                        }
                          </style>';
                    echo '<table  class="align-self-center">';
                    echo ' <tr> <th>Ticket Number</th>';
                    echo '<th>Ticket Information</th>';
                    echo '<th>Assigned Employee</th>';
                    echo '<th>Ticket Status</th>';
                    echo '<th>Delete Ticket</th> </tr>';
                    foreach ($tickets as $item) {
                        $id = $item->ticket_no;
                        echo "<tr>";
                        echo "<td>" . $item->ticket_no . "</td>";
                        echo "<td>" . nl2br($item->Information,false) . "</td>";
                        echo "<td>" . $item->emp_id . "</td>";
                        if ($item->status == "RESOLVED") {
                            echo "<td>" . $item->status;
                            echo "<br><form action='completed' method='post'>";
                            echo "<input type = 'hidden' name = '_token' value ='" . csrf_token() . "'>";
                            echo "<button name='completed' value='" . $id . "' type='submit'>Mark as Completed</input>";
                            echo "</form></td>";
                        } else {
                            echo "<td>" . $item->status . "</td>";
                        }

                        echo "<td><form action='deleteticket' method='post'>";
                        echo "<input type = 'hidden' name = '_token' value ='" . csrf_token() . "'>";
                        echo "<button name='delete' value='" . $id . "' type='submit'>delete</input>";
                        echo "</form></td>";
                        echo "</tr>";
                    }
                    echo '</table>';
                    echo '<p><a href="/customer">click here</a> to go to your home page</p>';
                }
                else{
                    echo '<p>No Tickets Found. Please create a ticket <a href="newticket">here</a></p><br>';
                    echo '<p><a href="/customer">click here</a> to go to your home page</p>';
                }
            }
        }
    }

        public function deleteticket(Request $req){
            echo "<style>
            p {
            text-align: center;
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }</style>";
            $data=$req->input();
            DB::update('update employee set availability="free" where id=(select emp_id from ticket where ticket_no=?)',[$data['delete']]);
            DB::delete('delete from ticket where ticket_no=?',[$data['delete']]);
            echo '<p>Ticket Deleted Successfully<br>';
            echo '<a href="/customer">click here</a> to go to your home page</p>';

        }

    public function customerlogout(Request $req){
        $req->session()->flush();
        return redirect('login');
    }

    public function completed(Request $req){
        echo "<style>
            p {
            text-align: center;
            font-size: 14px;
            font-weight: 100;
            line-height: 20px;
            letter-spacing: 0.5px;
            margin: 20px 0 30px;
        }</style>";
        $data=$req->input();
        DB::update('update employee set availability="free" where id=(select emp_id from ticket where ticket_no=?)',[$data['completed']]);
        DB::delete('update ticket set status="COMPLETED" where ticket_no=?',[$data['completed']]);
        echo '<p>Thank you for reporting the issue. If there are any other issues Do tell us.<br>';
        echo '<a href="/customer">click here</a> to go to your home page</p>';
    }
}
