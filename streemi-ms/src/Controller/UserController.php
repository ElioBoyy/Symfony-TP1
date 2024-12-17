class UserController extends AbstractController
{
    // ...existing code...

    public function create(Request $request): Response
    {
        $user = new User();
        // ...existing code...
        $user->setStatus($request->request->get('status', 'active'));
        // ...existing code...
    }

    public function update(Request $request, User $user): Response
    {
        // ...existing code...
        $user->setStatus($request->request->get('status', $user->getStatus()));
        // ...existing code...
    }

    // ...existing code...
}
