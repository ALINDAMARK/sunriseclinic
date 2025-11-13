<!-- Add Doctor Modal Partial -->
<div id="modal-add-doctor" class="hidden" aria-hidden="true">
    <div class="modal-overlay" id="modal-add-doctor-overlay" style="display:none;">
        <div class="modal-panel bg-white dark:bg-card-dark p-6" role="dialog" aria-modal="true" aria-labelledby="modal-add-doctor-title">
            <h2 id="modal-add-doctor-title" class="text-xl font-bold mb-4">Add Doctor</h2>
            <form id="modal-add-doctor-form" class="space-y-3">
                <div>
                    <label class="block text-sm text-gray-600">Full name</label>
                    <input id="ad-name" name="name" type="text" class="w-full rounded border px-3 py-2" required />
                    <div id="ad-name-error" class="text-sm text-red-600 mt-1" style="display:none;"></div>
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Specialty</label>
                    <input id="ad-specialty" name="specialty" type="text" class="w-full rounded border px-3 py-2" />
                    <div id="ad-specialty-error" class="text-sm text-red-600 mt-1" style="display:none;"></div>
                </div>
                <div>
                    <label class="block text-sm text-gray-600">Avatar URL (optional)</label>
                    <input id="ad-avatar" name="avatar_url" type="url" class="w-full rounded border px-3 py-2" />
                    <div id="ad-avatar-error" class="text-sm text-red-600 mt-1" style="display:none;"></div>
                </div>
                <div class="flex gap-2 justify-end mt-4">
                    <button type="button" id="ad-cancel" class="px-4 py-2 rounded border">Cancel</button>
                    <button type="submit" id="ad-submit" class="px-4 py-2 rounded bg-primary text-white">Create</button>
                </div>
            </form>
        </div>
    </div>
</div>
