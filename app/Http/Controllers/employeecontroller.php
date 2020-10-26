<?php

namespace App\Http\Controllers;

use App\Models\EmployeeInsert;
use Illuminate\Http\Request;
use \Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\DB;

class employeecontroller extends Controller
{
    public function authenticate(Request $request)
    {echo "<style>
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
            return redirect('employeelogin')
                ->withInput()
                ->withErrors($validator);
        } else {
            $data = $request->input();
            if ($employee = DB::table('employee')->where('email', $data['mail'])->first()) {
                $request->session()->put('email', $data['mail']);
                if ($employee->password == $data['password']) {
                    return view('employee');
                } else {
                    echo '<p>email id or password is incorrect. Please check and enter again <a href="/">here</a></p>';
                }
            } else {
                echo '<p>User does not exist. Please Contact the administrator</p>';
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
            echo "<p>No User Found. Please Login <a href='login'>here</a> again and try accessing this.</p>";
        } else {
            if ($cust = DB::table('employee')->where('email', '=', $email)->first()) {
                if (DB::table('ticket')->where('emp_id', '=', $cust->id)->first()) {
                    $tickets = DB::table('ticket')->where('emp_id', '=', $cust->id)->get();
                    echo '<style>
                                    table, th, td {
                                    border: 1px solid black;
                                     border-collapse: collapse;
                                        }
                          </style>';
                    echo '<table> <tr> <th>Ticket Number</th>';
                    echo '<th>Ticket Information</th>';
                    echo '<th>Customer ID</th>';
                    echo '<th>Ticket Status</th>';
                    echo '<th>change status</th> </tr>';
                    foreach ($tickets as $item) {
                        echo "<tr>";
                        $id = $item->ticket_no;
                        echo "<td>" . $item->ticket_no . "</td>";
                        echo "<td>" . $item->Information . "</td>";
                        echo "<td>" . $item->customer_id . "</td>";
                        echo "<td>" . $item->status . "</td>";
                        if ($item->status == "COMPLETED") {
                            echo "<td>the ticket is completed</td>";
                        } else if($item->status == "INVALID") {
                            echo "<td>the ticket is Invalid</td>";
                        }
                        else{
                            echo "<td><form action='changestatus' method='post'>";
                            echo "<input type = 'hidden' name = '_token' value ='" . csrf_token() . "'>";
                            echo "<select id='status' name='status'>";
                            echo "<option name='inprogress' id='inprogress'>IN PROGRESS</option>";
                            echo "<option name='invalid' id='invalid'>INVALID</option>";
                            echo "<option name='resolved' id='resolved'>RESOLVED</option>";
                            echo "</select>";
                            echo "<button name='submit' value='" . $id . "'type='submit'>change status</button>";
                            echo "</form></td>";
                            echo "</tr>";
                        }

                    }
                    echo '</table>';
                    echo '<p><a href="/employee">click here</a> to go to employee home page</p>';
                }
                else{
                    echo "<p>There are no tickets. Click <a href='employee'>here</a> to go to your home page</p>";
                }
            }
            else{
                echo "<p>there's something wrong with our server. Please login again <a href='login'>here</a></p>";
            }
        }
    }

    public function updateticket(Request $req){
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
        DB::update('update ticket set status=? where ticket_no=?',[$data['status'],$data['submit']]);
        if($data['status']=="INVALID"){
            DB::update('update employee set availability="free" where id=(select emp_id from ticket where ticket_no=?)',[$data['submit']]);
        }
        echo '<p>Ticket status updated Successfully<br>';
        echo '<a href="/employee">click here</a> to go to your home page</p>';
    }

    public function logout(Request $req){
        $req->session()->flush();
        return redirect("login");
    }
}



