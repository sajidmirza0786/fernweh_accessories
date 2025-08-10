<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Enquiry; // Import the Enquiry model
use Illuminate\Http\Request;

class EnquiryController extends Controller
{
    /**
     * Display a listing of the enquiries with search and pagination.
     */
    public function index(Request $request)
    {
        try {
            // Get the search query from the request
            $search = $request->query('q');

            // Start building the query
            $enquiries = Enquiry::query();

            // Apply search filter if a query is present
            if ($search) {
                $enquiries->where(function ($query) use ($search) {
                    $query->where('name', 'like', '%' . $search . '%')
                          ->orWhere('email', 'like', '%' . $search . '%')
                          ->orWhere('phone', 'like', '%' . $search . '%')
                          ->orWhere('subject', 'like', '%' . $search . '%')
                          ->orWhere('ip', 'like', '%' . $search . '%');
                });
            }

            // Order by latest enquiries and paginate
            $enquiries = $enquiries->latest()->paginate(20);

            // Return the view with the enquiries and search term
            return view('admin.enquiries.index', compact('enquiries', 'search'));
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Failed to load enquiries: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified enquiry.
     */
    public function show(Enquiry $enquiry)
    {
        try {
            return view('admin.enquiries.show', compact('enquiry'));
        } catch (\Exception $e) {
            return redirect()->route('admin.enquiries.index')->with('error', 'Failed to load enquiry: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified enquiry from storage.
     */
    public function destroy(Enquiry $enquiry)
    {
        try {
            $enquiry->delete();
            return redirect()->route('admin.enquiries.index')->with('success', 'Enquiry deleted successfully.');
        } catch (\Exception $e) {
            return redirect()->route('admin.enquiries.index')->with('error', 'Failed to delete enquiry: ' . $e->getMessage());
        }
    }
}
