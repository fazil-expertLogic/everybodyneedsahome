<?php

namespace App\Http\Controllers\Dashboard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\PurchasePlan;
use App\Models\Membership;
use App\Helpers\Helper;
use App\Helpers\StripeHelper;
use Carbon\Carbon;
use Illuminate\Support\Facades\Response;
class PurchasePlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $StripeHelper;

    public function __construct(StripeHelper $StripeHelper){
        $this->StripeHelper = $StripeHelper;
    }

    public function index(Request $request)
    {
        // PurchasePlan::get();
        $allow_show = Helper::check_rights(20)->is_show;
        $allow_create = Helper::check_rights(20)->is_create;
        $allow_edit = Helper::check_rights(20)->is_edit;
        $allow_delete = Helper::check_rights(20)->is_delete;

        $query = PurchasePlan::query();
        
        if ($request->filled('user_name')) {
            $query->whereHas('user', function($subquery) use ($request) {
                $subquery->where('name', 'like', '%' . $request->user_name . '%');
            });
        }
        if ($request->filled('plan_name')) {
            $query->whereHas('membership', function($subquery) use ($request) {
                $subquery->where('name', 'like', '%' . $request->plan_name . '%');
            });
        }
    
        if ($request->filled('search')) {
            $query->where(function($subquery) use ($request) {
                $subquery->whereHas('user', function($subquery) use ($request) {
                    $subquery->where('name', 'like', '%' . $request->search . '%');
                })
                ->orWhereHas('membership', function($subquery) use ($request) {
                    $subquery->where('name', 'like', '%' . $request->search . '%');
                });
            });
        }
    
        // Pagination
        $purchase_plans = $query->with('user','membership')->paginate(10);
        return view('livewire.purchase_plan.index', compact('purchase_plans','allow_show','allow_create','allow_edit','allow_delete'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::ClientProvider()->pluck('name','id');
        $member_ships =  Membership::nameWithPrice();
        return view('livewire.purchase_plan.add', compact('users', 'member_ships'));
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'member_ship_id' => 'required|exists:memberships,id',
                'stripeToken' => 'required|string',
                'last4' => 'required|numeric|digits:4',
                'exp_month' => 'required|numeric|between:1,12',
                'exp_year' => 'required|numeric|digits:4|after_or_equal:' . now()->year,
            ]);
            if ($validator->fails()) {
                dd($validator->errors());
                return response()->json($validator->errors(), 422);
            }
            DB::beginTransaction();
            // stripe
            $user = User::findOrFail($request->user_id);
            $member_ship = Membership::findOrFail($request->member_ship_id);
            $customerId = $this->StripeHelper->createCustomer($user->email, $user->name, $request->stripeToken);   
            $memberShipId = $member_ship->stripe_id;
            $stripeSubscription = $this->StripeHelper->createSubscription($customerId, $memberShipId, '');
            // end stripe
            PurchasePlan::create([
                'user_id'=> $request->user_id,
                'membership_id' => $request->member_ship_id,
                'stripe_customer_id'=>$customerId,
                'stripe_id'=>$stripeSubscription->id,
                'stripe_current_period_end' => $stripeSubscription->current_period_end,
                'purchase_date' => now(),
                'stripeToken' => $request->stripeToken,
                'last4' => $request->last4,
                'exp_month' => $request->exp_month,
                'exp_year' => $request->exp_year,
            ]);
        DB::commit();
            return redirect()->route('purchase_plans.index')->with('success', 'State create successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage());
            return redirect()->back()->withErrors(['error' => 'An error occurred while updating the State. Please try again.']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $purchase_plan = PurchasePlan::with('user','membership')->findOrFail($id);
        return view('livewire.purchase_plan.show', compact('purchase_plan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function export(Request $request)
    {
        // Fetch data dynamically based on request filters
        $query = DB::table('purchase_plan')
            ->select('id','user_id','membership_id','stripeToken','last4','exp_month','exp_year','stripe_customer_id','stripe_id','stripe_current_period_end','purchase_date','created_at');
    
        // Apply filters (if passed in the request)
        if ($request->has('start_date')) {
            $query->where('created_at', '>=', $request->start_date);
        }
    
        if ($request->has('end_date')) {
            $query->where('created_at', '<=', $request->end_date);
        }
    
        // Get the filtered data
        $data = $query->get();
    
        // Check if there are any users to export
        if ($data->isEmpty()) {
            return response()->json(['message' => 'No users found for the given criteria.'], 404);
        }
    
        // Prepare CSV headers
        $csvData = "ID,User ID,Membership Id,Stripe Token,Last4,Exp Month,Exp Year,Stripe Customer Id,Stripe Id,Stripe Current Period End,Purchase Date,Created At\n";
    
        // Loop through the users and append data to CSV
        foreach ($data as $value) {
            // Format the creation date
            $createdAt = Carbon::parse($value->created_at)->format('M d, Y g:i A'); // Format as 'Sep 30, 2024 3:45 PM'

            // Append data to CSV
            $csvData .= '"' . implode('","', [
                $this->sanitizeForCsv($value->id),
                $this->sanitizeForCsv($value->user_id),
                $this->sanitizeForCsv($value->membership_id),
                $this->sanitizeForCsv($value->stripeToken),
                $this->sanitizeForCsv($value->last4),
                $this->sanitizeForCsv($value->exp_month),
                $this->sanitizeForCsv($value->exp_year),
                $this->sanitizeForCsv($value->stripe_customer_id),
                $this->sanitizeForCsv($value->stripe_id),
                $this->sanitizeForCsv($value->stripe_current_period_end),
                $this->sanitizeForCsv($value->purchase_date),
                $createdAt
            ]) . "\"\n";
        }
    
        // Set the filename with a timestamp
        $fileName = 'Purchase_Plan_export_' . now()->format('Y_m_d_H_i_s') . '.csv';
    
        // Return the CSV response with proper headers
        return Response::make($csvData, 200, [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => "attachment; filename={$fileName}",
        ]);
    }
    
    private function sanitizeForCsv($value)
    {
        if ($value === null) {
            return '';
        }
        // Escape double quotes
        return str_replace('"', '""', $value);
    }
    public function import(Request $request)
    {   
        
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt',
        ]);
        $file = $request->file('csv_file');
        $path = $file->getRealPath();
        DB::beginTransaction(); // Start a database transaction
        try {
            if (($handle = fopen($path, 'r')) !== false) {
                $header = fgetcsv($handle, 1000, ','); // Get the first row as headers
                
                while (($row = fgetcsv($handle, 1000, ',')) !== false) {
                    
                    if (count($header) !== count($row)) {
                        continue;
                    }

                    $data = array_combine($header, $row);

                    // Check for duplicate records based on unique columns
                    $exists = PurchasePlan::where('membership_id', $data['Membership Id'] ?? null)
                        ->where('user_id', $data['User ID'] ?? null)
                        ->where('stripeToken', $data['Stripe Token'] ?? null)
                        ->exists();
                    
                    if ($exists) {
                        continue; // Skip this row if a duplicate record exists
                    }         

                    // Map CSV data to database fields
                    $purchase_plan = [
                        'user_id'=> $data['User ID']?? null,
                        'membership_id' => $data['Membership Id']?? null,
                        'stripeToken' => $data['Stripe Token']?? null,
                        'last4' => $data['Last4']?? null,
                        'stripe_customer_id'=>$data['Stripe Customer Id']?? null,
                        'stripe_id'=>$data['Stripe Id']?? null,
                        'stripe_current_period_end' => $data['Stripe Current Period End']?? null,
                        'purchase_date' => $data['Purchase Date'],
                        'exp_month' => $data['Exp Month']?? null,
                        'exp_year' => $data['Exp Year']?? null,
                    ];    
                    // Save the property
                    PurchasePlan::create($purchase_plan);
                }
                fclose($handle);
            }
            DB::commit(); // Commit the transaction if everything is successful
            return back()->with('success', 'CSV imported successfully!');
        } catch (\Exception $e) {
            dd($e->getMessage());
            DB::rollBack(); // Roll back the transaction on error
            return back()->withErrors(['error' => 'Failed to import CSV: ' . $e->getMessage()]);
        }
    }
}
