// ...existing code...
public function index(): Response
{
    if (!$this->getUser()) {
        return $this->redirectToRoute('homepage');
    }

    $playlists = $this->getUser()->getPlaylists();

    return $this->render('playlist/index.html.twig', [
        'playlists' => $playlists,
    ]);
}
// ...existing code...
