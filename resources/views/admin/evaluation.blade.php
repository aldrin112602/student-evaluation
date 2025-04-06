@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="content-wrapper p-4 border rounded shadow-sm">
        
        <!-- Tabs for Requests and Completed -->
        <ul class="nav nav-tabs" id="evaluationTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="requests-tab" data-bs-toggle="tab" href="#requests" role="tab" aria-controls="requests" aria-selected="true">Requests</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="completed-tab" data-bs-toggle="tab" href="#completed" role="tab" aria-controls="completed" aria-selected="false">Completed</a>
            </li>
        </ul>

        <div class="tab-content" id="evaluationTabsContent">
            <!-- Requests Tab Content -->
            <div class="tab-pane fade show active" id="requests" role="tabpanel" aria-labelledby="requests-tab">
                <div class="table-responsive shadow-lg rounded bg-white p-3">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 20%;">Student ID</th>
                                <th style="width: 20%;">Request Date</th>
                                <th style="width: 20%;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($pendingEvaluations as $request)
                            <tr>
                                <td>{{ $request->user_id }}</td>
                                <td>{{ \Carbon\Carbon::parse($request->created_at)->format('F d, Y') }}</td>
                                <td>
                                    <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#evaluateModal{{ $request->user_id }}">
                                        Evaluate
                                    </button>
                                </td>
                            </tr>

                        <!-- Confirmation Modal -->
<div class="modal fade" id="evaluateModal{{ $request->user_id }}" tabindex="-1" aria-labelledby="evaluateModalLabel{{ $request->user_id }}" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="evaluateModalLabel{{ $request->user_id }}">Confirm Evaluation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to evaluate the student with ID: <br><strong>{{ $request->user_id }}</strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <!-- Trigger the completion action via the new route -->
                <a href="{{ route('evaluation.complete', ['studentId' => $request->user_id]) }}" class="btn btn-primary">
                    Yes, Evaluate
                </a>
            </div>
        </div>
    </div>
</div>

                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- Completed Tab Content -->
            <div class="tab-pane fade" id="completed" role="tabpanel" aria-labelledby="completed-tab">
                <div class="table-responsive shadow-lg rounded bg-white p-3">
                    <table class="table table-hover table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th style="width: 20%;">Student ID</th>
                                <th style="width: 20%;">Evaluation</th>
                                <th style="width: 20%;">Request Date</th>
                                @if(auth()->user()->role === 'admin')
                                <th style="width: 20%;">Actions</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                        @foreach ($completedEvaluations as $note)
                            <tr>
                                <td>{{ $note->user_id }}</td>
                                <td>
                                    <button class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#noteModal{{ $note->id }}">
                                        Evaluation Details
                                    </button>
                                </td>
                                <td>{{ \Carbon\Carbon::parse($note->created_at)->format('F d, Y') }}</td>
                                @if(auth()->user()->role === 'admin')
                                <td>
                                    <form action="{{ route('evaluations.destroy', $note->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this note?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
