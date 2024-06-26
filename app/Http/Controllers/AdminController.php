<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\User;
use App\Models\Deal;
use App\Models\Beneficiary;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Models\ClientFxRequirement;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function search(Request $request)
    {


        // Retrieve search parameters from the request
        $names = $request->input('name');
       
        ///////////////////////
        if ($names !== null) {
            $names = explode(' ', $names);
            if (count($names) == 2) {
            $firstName = $names[0];
            $lastname = $names[1];
            }else if (count($names) == 1) {
                    $firstName = $names[0];
                    $lastname = null;
                    }
            
                }
            else{
                $firstName = null;
                $lastname = null;
            }
        
       

        /////////////////
        
        $id = $request->input('id');
        $phoneNo = $request->input('phone_no');
        $email = $request->input('email');
        $registeredDateFrom = $request->input('registered_from');
        //   $registeredFrom = \DateTime::createFromFormat('d-m-Y', $registeredDateFrom)->format('Y-m-d');

        $registeredDateTo = $request->input('registered_to');

        if (!isset($registeredDateFrom) && !isset($registeredDateTo)) {
            $registeredFrom = '0001-01-01';
            $registeredTo = Carbon::now()->toDateString();
        } elseif (isset($registeredDateFrom) && !isset($registeredDateTo)) {
            // $registeredFrom is set, but $registeredTo is not set
            $registeredFrom = \DateTime::createFromFormat('d-m-Y', $registeredDateFrom)->format('Y-m-d');
            // Set $registeredTo to the current date
            $registeredTo = Carbon::now()->toDateString();
        } elseif (!isset($registeredDateFrom) && isset($registeredDateTo)) {
            // $registeredFrom is not set, but $registeredTo is set
            // Set $registeredFrom to a date far in the past
            $registeredTo = \DateTime::createFromFormat('d-m-Y', $registeredDateTo)->format('Y-m-d');
            $registeredFrom = '0001-01-01'; // Or any other suitable date
        } else {
            // Both $registeredFrom and $registeredTo are set
            // No action needed, both dates are already set
            $registeredFrom = \DateTime::createFromFormat('d-m-Y', $registeredDateFrom)->format('Y-m-d');
            $registeredTo = \DateTime::createFromFormat('d-m-Y', $registeredDateTo)->format('Y-m-d');
        }
        //dd($registeredFrom);
        // dd($registeredFrom);
        $data = [];
        $currentUser = Auth::user();
        // Query to search clients
        // Case 1
        if ($firstName !== null && $lastname === null && $id !== null && $phoneNo !== null && $email !== null) {

            $results = Client::where('first_name', $firstName)
                ->where('id', $id)
                ->where('phone_no', $phoneNo)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 2
        else if ($firstName !== null && $lastname === null && $id !== null && $phoneNo !== null && $email === null) {

            $results = Client::where('first_name', $firstName)
                ->where('id', $id)
                ->where('phone_no', $phoneNo)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 3
        else if ($firstName !== null && $lastname === null && $id !== null && $phoneNo === null && $email !== null) {

            $results = Client::where('first_name', $firstName)
                ->where('id', $id)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 4
        else if ($firstName !== null && $lastname === null && $id !== null && $phoneNo === null && $email === null) {

            $results = Client::where('first_name', $firstName)
                ->where('id', $id)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 5
        else if ($firstName !== null && $lastname === null && $id === null && $phoneNo !== null && $email !== null) {

            $results = Client::where('first_name', $firstName)
                ->where('phone_no', $phoneNo)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 6
        else if ($firstName !== null && $lastname === null && $id === null && $phoneNo !== null && $email === null) {

            $results = Client::where('first_name', $firstName)
                ->where('phone_no', $phoneNo)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 7
        else if ($firstName !== null && $lastname === null && $id === null && $phoneNo === null && $email !== null) {

            $results = Client::where('first_name', $firstName)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 8
        else if ($firstName !== null && $lastname === null && $id === null && $phoneNo === null && $email === null) {

            $results = Client::where('first_name', $firstName)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 9
        else if ($firstName === null && $lastname === null && $id !== null && $phoneNo !== null && $email !== null) {

            $results = Client::where('id', $id)
                ->where('phone_no', $phoneNo)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 10
        else if ($firstName === null && $lastname === null && $id !== null && $phoneNo !== null && $email === null) {

            $results = Client::where('id', $id)
                ->where('phone_no', $phoneNo)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 11
        else if ($firstName === null && $lastname === null && $id !== null && $phoneNo === null && $email !== null) {

            $results = Client::where('id', $id)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 12
        else if ($firstName === null && $lastname === null && $id !== null && $phoneNo === null && $email === null) {
            //  dd($registeredFrom);
            $results = Client::where('id', $id)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }
        // Case 13
        else if ($firstName !== null && $lastname !== null && $id !== null && $phoneNo !== null && $email !== null ) {
      
            $results = Client::where('first_name', $firstName)->where('last_name',$lastname)
                ->where('id', $id)
                ->where('phone_no', $phoneNo)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }
        // Case 14
        else if ($firstName !== null && $lastname !== null && $id === null && $phoneNo === null && $email === null) {

            $results = Client::where('first_name', $firstName)->where('last_name', $lastname)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }
        // Case 15
        else if ($firstName !== null && $lastname !== null && $id === null && $phoneNo !== null && $email === null) {

            $results = Client::where('first_name', $firstName)->where('last_name', $lastname)
                ->where('phone_no', $phoneNo)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 16
        else if ($firstName !== null && $lastname !== null && $id === null && $phoneNo === null && $email !== null) {

            $results = Client::where('first_name', $firstName)->where('last_name', $lastname)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }
        // Case 17
        else if ($firstName !== null && $lastname !== null && $id !== null && $phoneNo === null && $email === null) {

            $results = Client::where('first_name', $firstName)->where('last_name', $lastname)
                ->where('id', $id)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 18
        else if ($firstName !== null && $lastname !== null && $id === null && $phoneNo !== null && $email !== null) {

            $results = Client::where('first_name', $firstName)->where('last_name', $lastname)
                ->where('phone_no', $phoneNo)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }
        // Case 19
        else if ($firstName !== null && $lastname !== null && $id !== null && $phoneNo !== null && $email === null) {

            $results = Client::where('first_name', $firstName)->where('last_name', $lastname)
                ->where('id', $id)
                ->where('phone_no', $phoneNo)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }

        // Case 20
        else if ($firstName !== null && $lastname !== null && $id !== null && $phoneNo === null && $email !== null) {

            $results = Client::where('first_name', $firstName)->where('last_name', $lastname)
                ->where('id', $id)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }
        else if ($firstName === null && $lastname === null && $id === null && $phoneNo === null && $email === null) {

            $results = Client::whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }
        else if ($firstName === null && $lastname === null && $id === null && $phoneNo !== null && $email !== null) {

            $results = Client::where('phone_no', $phoneNo)
                ->where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }
        else if ($firstName === null && $lastname === null && $id === null && $phoneNo === null && $email !== null) {

            $results = Client::where('email', $email)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }
        else if ($firstName === null && $lastname === null && $id === null && $phoneNo !== null && $email === null) {

            $results = Client::where('phone_no', $phoneNo)
                ->whereBetween('created_at', [$registeredFrom, $registeredTo])
                ->get();
        }
      
        
        if ($results->isEmpty()) {
            return response()->json(['message' => 'No results found', 'status_code' => 404], 404);
        } else {
            foreach ($results as $client) {
                $user = User::where('parent_id', $client->id)
                    ->Where('client_id', $client->id)
                    ->first();



                $contactCount = User::whereNull('parent_id')
                    ->where('client_id', $client->id)
                    ->count();
                $beneficiariesCount = Beneficiary::where('client_id', $client->id)->count();
                // Push client data to the array
                $data[] = [
                    'client_code ' => $client->id,
                    'status' => $user->status,
                    'client_name' => $client->first_name . ' ' . $client->last_name,
                    'client_email' => $client->email,
                    'no_of_contact' => $contactCount,
                    'phone_no' => $client->phone_no,
                    'spot' => null,
                    'forward' => null,
                    'beneficiary' => $beneficiariesCount,
                    'spot trading' => null,
                    'forward trading' => null,
                    'kyc status' => null,
                    'customer type' => 'Business',
                    'registered on' => $client->created_at->format('d-m-Y'),
                    'account manager' => $currentUser->firstname . ' ' . $currentUser->lastname
                ];
            }
        }




        return response()->json(['data' => $data, 'status_code' => 200]);
    }
    public function index()
    {
        $clients = Client::all();
        $data = [];
        $currentUser = Auth::user();

        foreach ($clients as $client) {
            $user = User::where('parent_id', $client->id)
                ->Where('client_id', $client->id)
                ->first();



            $contactCount = User::whereNull('parent_id')
                ->where('client_id', $client->id)
                ->count();
            $beneficiariesCount = Beneficiary::where('client_id', $client->id)->count();
            // Push client data to the array
            $data[] = [
                'id' => $client->id,
                'status' => $user->status,
                'client_name' => $client->first_name . ' ' . $client->last_name,
                'no_of_contact' => $contactCount,
                'phone_no' => $client->phone_no,
                'spot' => null,
                'forward' => null,
                'beneficiary' => $beneficiariesCount,
                'spot_trading' => null,
                'forward_trading' => null,
                'kyc_status' => null,
                'customer type' => 'Business',
                'registered_on' => $client->created_at->format('d-m-Y'),
                'account_manager' => $currentUser->firstname . ' ' . $currentUser->lastname
            ];
        }

        // Return response with the data
        return response()->json(['data' => $data, 'status_code' => 200]);
    }
    public function show($id)
    {

        $client = Client::findOrFail($id);
        if ($client) {
            $client_country  = DB::table('countries')->where('id', $client->country_id)->first();
            $client->client_country = $client_country->name;
            $paymentType = $paymentType = DB::table('payment_types')->where('id', $client->payment_type_id)->first();
            $client->payment_type = $paymentType->value;
            $category = DB::table('categories')->where('id', $client->category_id)->first();
            $client->category = $category->value;
            $subCategory = DB::table('sub_categories')->where('id', $client->subcategory_id)->first();
            $client->subcategory = $subCategory->value;
            $Fx_requirement = ClientFxRequirement::where('client_id', '=', $client->id)->first();

            $paymentPerMonth = DB::table('payment_per_months')->where('id', $Fx_requirement->payment_per_month_id)->first();
            $client->payment_per_month = $paymentPerMonth->value;
            $paymentSchedule = DB::table('payment_schedules')->where('id', $Fx_requirement->payment_schedule_id)->first();
            $client->payment_schedule = $paymentSchedule->value;

            $priceRange = DB::table('price_ranges')->where('id', $Fx_requirement->price_range_id)->first();
            $client->price_range = $priceRange->value;

            $medium = DB::table('mediums')->where('id', $Fx_requirement->medium_id)->first();
            $client->medium = $medium->value;




            $makingPayments = DB::table('client_fx_requirement_countries_making_payment')
                ->where('client_fx_requirement_id', $Fx_requirement->id)
                ->get();
            $country = [];
            foreach ($makingPayments as $payment) {
                $allCountry = DB::table('countries')->where('id', $payment->country_id)->value('name');
                $country[] = $allCountry;
            }

            $client->makingPaymentsCountry = $country;
        }
        $receivingPayments = DB::table('client_fx_requirement_countries_receiving_payment')
            ->where('client_fx_requirement_id', $Fx_requirement->id)
            ->get();

        $receiveCountry = [];

        foreach ($receivingPayments as $payment) {
            $allCountryReceive = DB::table('countries')->where('id', $payment->country_id)->value('name');
            $receiveCountry[] = $allCountryReceive;
        }

        $client->receivingPaymentsCountry = $receiveCountry;

        $fundSources = DB::table('client_fx_requirement_fund_source')
            ->where('client_fx_requirement_id', $Fx_requirement->id)
            ->get();

        $fundSourcesData = [];

        foreach ($fundSources as $source) {
            $sourceName = DB::table('funds_sources')->where('id', $source->fund_source_id)->value('value');
            $fundSourcesData[] = $sourceName;
        }

        $client->fundSources = $fundSourcesData;

        $paymentPurposes = DB::table('client_fx_requirement_payment_purpose')
            ->where('client_fx_requirement_id', $Fx_requirement->id)
            ->get();

        $paymentPurposesData = [];

        foreach ($paymentPurposes as $purpose) {
            $purposeName = DB::table('payment_purposes')->where('id', $purpose->payment_purpose_id)->value('value');
            $paymentPurposesData[] = $purposeName;
        }

        $client->paymentPurposes = $paymentPurposesData;

        $authorizeContactData = User::where('parent_id', null) // Select users where parent_id is null
            ->where('client_id', $id) // Match client_id with the provided $request->client_id
            ->select('firstname', 'lastname', 'email', 'status')
            ->get();
        foreach ($authorizeContactData as $contact) {
            $contact->next_verification = 'Next Verification';
            $contact->online_access = '';
            $contact->rates = '';
            $contact->deal_booking = '';
            $contact->dual_auth = '';
            $contact->user_type = '';
            $contact->kyc_status = '';
            $contact->beneficiaries = Beneficiary::where('client_id', $id)->count();
            $contact->spot_trader = '';
            $contact->forward_trader = '';
            $contact->registered_no = "Registered No";
        }

        $client->authorizeContact = $authorizeContactData;

        $clientData[] = $client;

        unset($client['category_id'], $client['payment_type_id'], $client['subcategory_id'], $client['country_id']); // Remove the specified fields from the array
        // dd($clientData);
        return response()->json(['data' => $clientData, 'status_code' => 200], 200);
    }

    public function allBeneficiaries(Request $request, $client_id)
    {
        // Fetch beneficiaries based on the client_id
        $beneficiaries = Beneficiary::where('client_id', $client_id)->get();
        if ($beneficiaries->isEmpty()) {
            // If no beneficiaries exist, return a message
            return response()->json(['message' => 'No beneficiaries found for the client.', 'status code' => 404], 404);
        }
        foreach ($beneficiaries as $beneficiar) {
            if (!empty($beneficiar->full_name)) {
                // If full_name is not empty, assign it to the variable
                $beneficiaryName = $beneficiar->full_name;
            } else if (!empty($beneficiar->business_name)) {
                // If full_name is empty but business_name is not empty, assign business_name to the variable
                $beneficiaryName = $beneficiar->business_name;
            }
            $beneficiar->Beneficiaries = $beneficiaryName;
            $client = Client::where('id', '=', $beneficiar->client_id)->first();
            $countryName = DB::table('countries')->where('id', $beneficiar->country_id)->value('name');
            $currencyCode = DB::table('currencies')->where('id', $beneficiar->currency_id)->value('code');

            $beneficiar->created_by = $client->first_name . ' ' . $client->last_name;
            $beneficiar->country = $countryName;
            $beneficiar->currency = $currencyCode;
            $beneficiar->makeHidden(['client_id', 'country_id', 'currency_id', 'business_name', 'full_name']);
        }

        // Return the fetched beneficiaries as JSON response
        return response()->json(['data' => $beneficiaries, 'status code' => 200]);
    }

    public function searchBeneficiaries(Request $request)
    {
        // Initialize the query

        $beneficiary = $request->input('Beneficiaries');
        //    dd($beneficiary);
        $country = $request->input('country_id');
        $iban_account_no = $request->input('iban_account_no');
        $currency = $request->input('currency_id');

        $query = Beneficiary::query();

        // Apply search filters based on the provided parameters



        // Case 1: beneficiary is not null, country_id is null, iban_account_no is null, currency_id is null
        if ($beneficiary !== null && $country === null && $iban_account_no === null && $currency === null) {
            $query->where('full_name', $beneficiary)->orWhere('business_name', $beneficiary);
        }

        // Case 2: beneficiary is null, country_id is not null, iban_account_no is null, currency_id is null
        elseif ($beneficiary === null && $country !== null && $iban_account_no === null && $currency === null) {
            $query->where('country_id', $country);
        }

        // Case 3: beneficiary is null, country_id is null, iban_account_no is not null, currency_id is null
        elseif ($beneficiary === null && $country === null && $iban_account_no !== null && $currency === null) {
            $query->where('iban_account_no', $iban_account_no);
        }
        // Case 4: beneficiary is null, country_id is null, iban_account_no is null, currency_id is not null
        elseif ($beneficiary === null && $country === null && $iban_account_no === null && $currency !== null) {
            $query->where('currency_id', $currency);
        }

        // Case 5: beneficiary is null, country_id is null, iban_account_no is not null, currency_id is not null
        elseif ($beneficiary === null && $country === null && $iban_account_no !== null && $currency !== null) {
            $query->where('currency_id', $currency)
                ->where('iban_account_no', $iban_account_no);
        }

        // Case 6: beneficiary is null, country_id is not null, iban_account_no is null, currency_id is not null
        elseif ($beneficiary === null && $country !== null && $iban_account_no === null && $currency !== null) {
            $query->where('currency_id', $currency)
                ->where('country_id', $country);
        }
        // Case 7: beneficiary is not null, country_id is null, iban_account_no is null, currency_id is not null
        elseif ($beneficiary !== null && $country === null && $iban_account_no === null && $currency !== null) {
            $query->where('currency_id', $currency)
                ->where('full_name', $beneficiary)->orWhere('business_name', $beneficiary);
        }
        // Case 8: beneficiary is  null, country_id is not null, iban_account_no is not null, currency_id is  null
        elseif ($beneficiary === null && $country !== null && $iban_account_no !== null && $currency === null) {
            $query->where('country_id', $country)
                ->where('iban_account_no', $iban_account_no);
        }
        // Case 9: beneficiary is null, country_id is not null, iban_account_no is not null, currency_id is not null
        elseif ($beneficiary === null && $country !== null && $iban_account_no !== null && $currency !== null) {
            $query->where('currency_id', $currency)
                ->where('country_id', $country)
                ->where('iban_account_no', $iban_account_no);
        }


        // Case 10: beneficiary is not null, country_id is null, iban_account_no is not null, currency_id is not null
        elseif ($beneficiary !== null && $country === null && $iban_account_no !== null && $currency !== null) {
            $query->where('currency_id', $currency)
                ->where('full_name', $beneficiary)->orWhere('business_name', $beneficiary)
                ->where('iban_account_no', $iban_account_no);
        }

        // Case 11: beneficiary is not null, country_id is not null, iban_account_no is null, currency_id is not null
        elseif ($beneficiary !== null && $country !== null && $iban_account_no === null && $currency !== null) {
            $query->where('currency_id', $currency)
                ->where('full_name', $beneficiary)->orWhere('business_name', $beneficiary)
                ->where('country_id', $country);
        }

        // Case 12: beneficiary is not null, country_id is not null, iban_account_no is not null, currency_id is null
        elseif ($beneficiary !== null && $country !== null && $iban_account_no !== null && $currency !== null) {
            $query->where('currency_id', $currency)
                ->where('full_name', $beneficiary)->orWhere('business_name', $beneficiary)
                ->where('country_id', $country)
                ->where('iban_account_no', $iban_account_no);
        }


        // Fetch search results
        $results = $query->get();
        foreach ($results as $beneficiar) {
            if (!empty($beneficiar->full_name)) {
                // If full_name is not empty, assign it to the variable
                $beneficiaryName = $beneficiar->full_name;
            } else if (!empty($beneficiar->business_name)) {
                // If full_name is empty but business_name is not empty, assign business_name to the variable
                $beneficiaryName = $beneficiar->business_name;
            }
            $country  = DB::table('countries')->where('id', $beneficiar->country_id)->first();
            $currency  = DB::table('countries')->where('id', $beneficiar->currency_id)->first();
            $beneficiar->country = $country->name;
            $beneficiar->currency = $currency->name;
            $beneficiar->Beneficiaries = $beneficiaryName;
        }
        if ($results->isEmpty()) {
            return response()->json(['message' => 'No results found', 'status_code' => 404], 404);
        }
        // Return the results
        return response()->json(['data' => $results, 'status code' => 200]);
    }
    public function makeDeal(Request $request)
    {
        // Validate the request data
        $request->validate([
            'buy_amount' => 'required|numeric|min:0',
            'sell_amount' => 'required|numeric|min:0',
            'buy_currency' => 'required|string',
            'sell_currency' => 'required|string',
            'market_rate' => 'required|numeric|min:0',
            'suggested_exchange_rate' => 'required|numeric|min:0',
            're_quoted_rate' => 'required|numeric|min:0',
            'margin' => 'required|numeric|min:0',
            'revenue' => 'required|numeric|min:0',
            'value_date' => 'required|date',
            'total_payable_amount' => 'required|numeric|min:0',
            'total_fees' => 'required|numeric|min:0',
            'purchase_amount_remaining' => 'required|numeric|min:0',
        ]);

        // Create a new deal instance
        $deal = new Deal();
        $deal->client_id = $request->client_id;
        $deal->buy_amount = $request->buy_amount;
        $deal->buy_currency = $request->buy_currency;
        $deal->sell_amount = $request->sell_amount;
        $deal->sell_currency = $request->sell_currency;
        $deal->market_rate = $request->market_rate;
        $deal->suggested_exchange_rate = $request->suggested_exchange_rate;
        $deal->re_quoted_rate = $request->re_quoted_rate;
        $deal->margin = $request->margin;
        $deal->revenue = $request->revenue;
        $deal->value_date = $request->value_date;
        $deal->beneficiary_id = $request->beneficiary_id;
        $deal->total_payable_amount = $request->total_payable_amount;
        $deal->total_fees = $request->total_fees;
        $deal->purchase_amount_remaining = $request->purchase_amount_remaining;

        // Save the deal
        $deal->save();

        // Return a success response
        return response()->json(['message' => 'Deal created successfully', 'status code' => 201], 201);
    }

    public function getAllDeals()
    {
        // Retrieve all deals
        $deals = Deal::get();
        $user = Auth::user();
        foreach ($deals as $deal) {
            $client = Client::where('id', '=', $deal->client_id)->first();
            $deal->customer_name = $client->first_name . ' ' . $client->last_name;
            $deal->trade_date = $deal->created_at;
            $deal->value_date = $deal->created_at;
            $deal->manage_by = $user->firstname . ' ' . $user->lastname;
        }

        // Return the deals as JSON response
        return response()->json(['data' => $deals, 'status code' => 200]);
    }
    public function searchDeals(Request $request)
    {
        $customerName = $request->input('customer_name');
        $clientCode = $request->input('client_code');
        $dealNo = $request->input('deal_no');
        $formattedDateFrom = $request->input('start_from');
        $formattedDateTo = $request->input('end_to');
        $sellCurrency = $request->input('sell_currency');
        $buyCurrency = $request->input('buy_currency');
        $status = $request->input('status');

        $startFrom = \DateTime::createFromFormat('d-m-Y', $formattedDateFrom)->format('Y-m-d');
        $endTo = \DateTime::createFromFormat('d-m-Y', $formattedDateTo)->format('Y-m-d');
        // Build query
        $query = Deal::query();

        if ($customerName) {
            $nameParts = explode(' ', $customerName, 2);
            // dd($nameParts);
            if (count($nameParts) === 2) {
                $customerFirstName = $nameParts[0];
                $customerLastName = $nameParts[1];
                $query->whereHas('client', function ($query) use ($customerFirstName, $customerLastName) {
                    $query->where(function ($query) use ($customerFirstName, $customerLastName) {
                        $query->where('first_name', 'like', '%' . $customerFirstName . '%')
                            ->orWhere('last_name', 'like', '%' . $customerLastName . '%');
                    });
                });
            } else {
                $query->whereHas('client', function ($query) use ($customerName) {
                    $query->where(function ($query) use ($customerName) {
                        $query->where('first_name', 'like', '%' . $customerName . '%')
                            ->orWhere('last_name', 'like', '%' . $customerName . '%');
                    });
                });
            }
        }

        if ($clientCode) {
            $query->whereHas('client', function ($query) use ($clientCode) {
                $query->where('id', $clientCode);
            });
        }

        if ($dealNo) {
            $query->where('id', $dealNo);
        }

        if (($startFrom !== null || $endTo !== null) && $startFrom !== $endTo) {
            $query->where(function ($q) use ($startFrom, $endTo) {

                if ($startFrom !== null && $endTo !== null) {

                    $q->whereBetween('created_at', [$startFrom, $endTo]);
                } elseif ($startFrom !== null) {
                    $q->where('created_at', '>=', $startFrom);
                } elseif ($endTo !== null) {
                    $q->where('created_at', '<=', $endTo);
                }
            });
        }

        if ($sellCurrency) {
            $query->where('sell_currency', $sellCurrency);
        }

        if ($buyCurrency) {
            $query->where('buy_currency', $buyCurrency);
        }

        if ($status) {
            $query->where('status', $status);
        }
        $user = Auth::user();

        // Execute the query
        $results = $query->get();

        //     dd($query->toSql());
        foreach ($results as $deal) {
            $client = Client::where('id', '=', $deal->client_id)->first();
            $deal->customer_name = $client->first_name . ' ' . $client->last_name;
            $deal->trade_date = $deal->created_at;
            $deal->value_date = $deal->created_at;
            $deal->manage_by = $user->firstname . ' ' . $user->lastname;
        }
        if ($results->isEmpty()) {
            return response()->json(['message' => 'No results found', 'status_code' => 404], 404);
        } else {
            return response()->json(['data' => $results, 'status_code' => 200]);
        }
    }

    public function activateUser(Request $request, $id)
    {
        // Activate the user
        $user = User::findOrFail($id);
        $user->update(['status' => 'active']);

        return response()->json(['message' => 'User activated successfully', 'user' => $user, 'status code' => 200], 200);
    }

    public function todayRevenue()
    {
        $totalRevenue = Deal::sum('revenue');

        return response()->json(['total_revenue' => $totalRevenue]);
    }
    public function previousMonthRevenue()
    {
        // Calculate the date range for the previous month
        $startDate = Carbon::now()->subMonth()->startOfMonth();
        $endDate = Carbon::now()->subMonth()->endOfMonth();

        // Retrieve deals created in the previous month and sum their revenue
        $totalRevenue = Deal::whereBetween('created_at', [$startDate, $endDate])->sum('revenue');

        return response()->json(['total_revenue_previous_month' => $totalRevenue]);
    }
    public function beforePreviousMonth()
    {
        // Calculate the date range for the period before the previous month (e.g., last three months)
        $startDate = Carbon::now()->startOfMonth()->subMonths(2)->startOfMonth();
        $endDate = Carbon::now()->startOfMonth()->subMonths(2)->endOfMonth();

        // Retrieve deals created in the specified period and sum their revenue
        $totalRevenue = Deal::whereBetween('created_at', [$startDate, $endDate])->sum('revenue');

        return response()->json(['total_revenue_before_previous_month' => $totalRevenue]);
    }

    public function totalDealsToday()
    {
        // Get the current date
        $today = Carbon::today();

        // Count the number of deals created today
        $totalDealsToday = Deal::whereDate('created_at', $today)->count();

        return response()->json(['total_deals_today' => $totalDealsToday]);
    }

    public function allClientsdeals(Request $request, $id)
    {
        // Retrieve all deals
        $deals = Deal::Where('client_id', '=', $id)->get();
        $user = Auth::user();
        foreach ($deals as $deal) {
            $client = Client::where('id', '=', $deal->client_id)->first();
            $deal->customer_name = $client->first_name . ' ' . $client->last_name;
            $deal->trade_date = $deal->created_at;
            $deal->value_date = $deal->created_at;
            $deal->manage_by = $user->firstname . ' ' . $user->lastname;
            $deal->beneficiary = Beneficiary::where('client_id', '=', $client->id)->count();
        }

        // Return the deals as JSON response
        return response()->json(['data' => $deals, 'status code' => 200]);
    }
    public function allDealOFClient(Request $request, $id)
    {

        $customerName = $request->input('customer_name');
        $clientCode = $request->input('client_code');
        $dealNo = $request->input('deal_no');
        $formattedDateFrom = $request->input('start_from');
        $formattedDateTo = $request->input('end_to');
        $sellCurrency = $request->input('sell_currency');
        $buyCurrency = $request->input('buy_currency');
        $status = $request->input('status');

        //  dd($customerName);
        if ($formattedDateFrom != null) {
            $startFrom = \DateTime::createFromFormat('d-m-Y', $formattedDateFrom)->format('Y-m-d');
        } else {
            $startFrom = '1970-01-01';
        }
        if ($formattedDateTo != null) {
            $endTo = \DateTime::createFromFormat('d-m-Y', $formattedDateTo)->format('Y-m-d');
        } else {
            $endTo = Carbon::now()->format('Y-m-d');
        }


        // Build query
        $query = Deal::where('client_id', '=', $id);

        if ($customerName) {
            $nameParts = explode(' ', $customerName, 2);
            // dd($nameParts);
            if (count($nameParts) === 2) {
                $customerFirstName = $nameParts[0];
                $customerLastName = $nameParts[1];
                $query->whereHas('client', function ($query) use ($customerFirstName, $customerLastName) {
                    $query->where(function ($query) use ($customerFirstName, $customerLastName) {
                        $query->where('first_name', 'like', '%' . $customerFirstName . '%')
                            ->orWhere('last_name', 'like', '%' . $customerLastName . '%');
                    });
                });
            } else {
                $query->whereHas('client', function ($query) use ($customerName) {
                    $query->where(function ($query) use ($customerName) {
                        $query->where('first_name', 'like', '%' . $customerName . '%')
                            ->orWhere('last_name', 'like', '%' . $customerName . '%');
                    });
                });
            }
        }

        if ($clientCode) {
            $query->whereHas('client', function ($query) use ($clientCode) {
                $query->where('id', $clientCode);
            });
        }

        if ($dealNo) {
            $query->where('id', $dealNo);
        }

        if ($startFrom && $endTo) {
            $query->whereBetween('created_at', [$startFrom, $endTo]);
        }

        if ($sellCurrency) {
            $query->where('sell_currency', $sellCurrency);
        }

        if ($buyCurrency) {
            $query->where('buy_currency', $buyCurrency);
        }

        if ($status) {
            $query->where('status', $status);
        }
        $user = Auth::user();

        // Execute the query
        $results = $query->get();
        foreach ($results as $deal) {
            $client = Client::where('id', '=', $deal->client_id)->first();

            $deal->customer_name = $client->first_name . ' ' . $client->last_name;
            $deal->trade_date = $deal->created_at;
            $deal->value_date = $deal->created_at;
            $deal->manage_by = $user->firstname . ' ' . $user->lastname;
            $deal->beneficiary = Beneficiary::where('client_id', '=', $client->id)->count();
        }
        if ($results->isEmpty()) {
            return response()->json(['message' => 'No results found', 'status_code' => 404], 404);
        } else {
            return response()->json(['data' => $results, 'status_code' => 200]);
        }
    }
}
