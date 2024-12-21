<?php

namespace App\Http\Controllers;

use App\Http\Requests\RecordCategories\StoreRecordCategoryRequest;
use App\Http\Requests\RecordCategories\UpdateRecordCategoryRequest;
use App\Models\RecordCategory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

final class RecordCategoryController extends Controller
{
    use AuthorizesRequests;

    public function index(Request $request): View
    {
        /** @var \App\Models\User $user */
        $user = $request->user();

        $categories = $user
            ->recordCategories()
            ->paginate();

        return view('record-categories.index', [
            'recordCategories' => $categories->withQueryString(),
        ]);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function create(): View
    {
        $this->authorize('create', RecordCategory::class);

        return view('record-categories.create');
    }

    public function store(StoreRecordCategoryRequest $request): RedirectResponse
    {
        $category = new RecordCategory();
        $category->user()->associate($request->user());
        $category->name = $request->validated('name');
        $category->save();

        return redirect()->route('record-categories.edit', $category);
    }

    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(RecordCategory $recordCategory): View
    {
        $this->authorize('update', $recordCategory);

        return view('record-categories.edit', [
            'recordCategory' => $recordCategory,
        ]);
    }

    public function update(UpdateRecordCategoryRequest $request, RecordCategory $recordCategory): RedirectResponse
    {
        $recordCategory->name = $request->validated('name');
        $recordCategory->save();

        return redirect()->route('record-categories.index');
    }


    /**
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function destroy(Request $request, RecordCategory $recordCategory): RedirectResponse
    {
        $this->authorize('delete', $recordCategory);

        $recordCategory->delete();

        return redirect()->route('record-categories.index');
    }
}
