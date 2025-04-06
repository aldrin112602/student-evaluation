@extends('layouts.app')

@section('content')
<div class="container">
    <div class="content-wrapper p-4 border rounded shadow-sm ">

        <div class="mb-4 text-center">
            <h2 style="border-bottom: 2px solid #000; padding-bottom: 10px; font-family: 'Bebas Neue', sans-serif;">Evaluations</h2>
        </div>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if(auth()->user()->role === 'faculty')
            <div class="mb-2">
                <input type="text" id="searchInput" class="form-control" placeholder="Search by Student ID" onkeyup="filterTable()" style="max-width: 250px; width: 100%;">
            </div>
        @endif

        <div class="table-responsive">
            <div class="row">
                @foreach ($notes as $note)
                    <div class="col-12 mb-4">
                        <div class="border p-4 rounded shadow-sm">
                            <p style="text-align:left;"><strong>Student ID:</strong> {{ $note->student_id }}</p>
                            <p style="text-align:left; margin-bottom: 40px;"><strong>Student Name:</strong> {{ $note->student_name }}</p>

                            <p style="text-align:left;"><strong>Deficiencies:</strong></p>
                            <textarea readonly class="form-control note-textarea" rows="5">{{ $note->note }}</textarea>

                            <p style="text-align:left;"><strong>Advise:</strong></p>
                            <textarea readonly class="form-control note-textarea" rows="5">{{ $note->advise }}</textarea>
                            
                            <p style="text-align:left;"><strong>Recommendations:</strong></p>
                            <textarea readonly class="form-control note-textarea" rows="5">{{ $note->recommendations }}</textarea>

                            <p style="text-align:left;"><strong>Results:</strong></p>
                            <textarea readonly class="form-control note-textarea" rows="5">{{ $note->results }}</textarea>

                            <p style="text-align:left; margin-top: 10px;"><strong>Evaluated By:</strong> {{ $note->evaluated_by }}</p>

                            <p><strong>Evaluation Date:</strong> {{ \Carbon\Carbon::parse($note->updated_at)->format('F d, Y') }}</p>
             

                            @if(auth()->user()->role === 'admin' || auth()->user()->role === 'faculty')
    <button type="button" class="btn btn-primary btn-sm" onclick="printEvaluation('{{ addslashes($note->student_id) }}', '{{ addslashes($note->student_name) }}', '{{ addslashes($note->note) }}', '{{ addslashes($note->advise) }}', '{{ addslashes($note->recommendations) }}', '{{ addslashes($note->results) }}', '{{ addslashes($note->evaluated_by) }}', '{{ \Carbon\Carbon::parse($note->created_at)->format('F d, Y') }}')">Print</button>
@endif


                            @if(auth()->user()->role === 'admin')
                                <form action="{{ route('evaluations.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this note?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>

<script>
    function printEvaluation(studentId, studentName, deficiencies, advise, recommendations, results, evaluatedBy, evaluationDate) {
        var printWindow = window.open('', '', 'width=800,height=600');

        // Start writing the print content
        printWindow.document.write('<html><head><title>Print Evaluation</title>');
        
        // Styles for the print page
        printWindow.document.write('<style>');
        printWindow.document.write('body { font-family: Arial, sans-serif; padding: 20px; margin: 0; background-color: #f4f4f4; }');
        printWindow.document.write('.container { padding: 20px; background-color: #fff; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1); margin-top: 20px; }');
        printWindow.document.write('.header { text-align: center; margin-bottom: 30px; }');
        printWindow.document.write('.header img { max-width: 100px; margin-bottom: 15px; }');
        printWindow.document.write('.header h3 { font-size: 22px; font-weight: bold; color: #333; margin: 0; }');
        printWindow.document.write('.header p { font-size: 18px; color: #333; margin: 5px 0; font-weight: bold; }');
        printWindow.document.write('.content p { font-size: 16px; line-height: 1.6; margin: 8px 0; }');
        printWindow.document.write('.content .deficiencies, .content .advise, .content .recommendations, .content .results { font-family: "Courier New", monospace; border: 1px dashed #000; padding: 10px; margin-top: 10px; background-color: #f9f9f9; }');
        printWindow.document.write('.footer { text-align: center; margin-top: 30px; font-size: 14px; color: #6c757d; }');
        printWindow.document.write('@media print { body { margin: 0; padding: 0; } img { max-width: 100px; } }</style>');
        
        printWindow.document.write('</head><body>');

        // Insert header with logo and title
        printWindow.document.write('<div class="container">');
        printWindow.document.write('<div class="header">');
        printWindow.document.write('<img src="{{ asset('images/logo.jpg') }}" alt="Logo">');
        printWindow.document.write('<h3>Student Evaluation System</h3>');
        printWindow.document.write('<p>Bachelor of Science in Information Technology</p>');
        printWindow.document.write('</div>');

        // Insert evaluation details in the content section
        printWindow.document.write('<div class="content">');
        printWindow.document.write('<p><strong>Evaluation Date:</strong> ' + evaluationDate + '</p>');
        printWindow.document.write('<p><strong>Student Name:</strong> ' + studentName + '</p>');
        printWindow.document.write('<p><strong>Student ID:</strong> ' + studentId + '</p>');

        // Deficiencies section
        printWindow.document.write('<p><strong>Deficiencies:</strong></p>');
        printWindow.document.write('<div class="deficiencies">' + deficiencies.replace(/\n/g, '<br>') + '</div>');

        // Advise section
        printWindow.document.write('<p><strong>Advise:</strong></p>');
        printWindow.document.write('<div class="advise">' + advise.replace(/\n/g, '<br>') + '</div>');

        // Recommendations section
        printWindow.document.write('<p><strong>Recommendations:</strong></p>');
        printWindow.document.write('<div class="recommendations">' + recommendations.replace(/\n/g, '<br>') + '</div>');

        // Results section
        printWindow.document.write('<p><strong>Results:</strong></p>');
        printWindow.document.write('<div class="results">' + results.replace(/\n/g, '<br>') + '</div>');

        // Evaluated by section
        printWindow.document.write('<p><strong>Evaluated By:</strong> ' + evaluatedBy + '</p>');

        // Noted By information (right-aligned)
        printWindow.document.write('<div style="height: 35px;"></div>'); // Adding space
        printWindow.document.write('<p style="text-align: right;"><strong>Noted By:</strong> Engr. Ryan John L. De Lara</p>');
        printWindow.document.write('<p style="text-align: right; margin-right: 60px;">CECT Dean</p>');

        printWindow.document.write('</div>'); // End content section

        // Footer section
        printWindow.document.write('<div class="footer">');
        printWindow.document.write('<p>Evaluation Report</p>');
        printWindow.document.write('</div>');

        printWindow.document.write('</div></body></html>');
        printWindow.document.close(); // Close the document

        // Trigger the print dialog (this is the part that opens the printer dialog)
        printWindow.print();
    }
</script>


<style>
    .content-wrapper {
        border: 1px solid #ddd;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        background-color: #fff;
    }

    
</style>

@endsection
