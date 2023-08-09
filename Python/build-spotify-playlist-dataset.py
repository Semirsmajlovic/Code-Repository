# Import modules
import spotipy
from spotipy.oauth2 import SpotifyClientCredentials 
import pandas as pd
from pathlib import Path
from youtube_search import YoutubeSearch

# Spotify API credentials
client_id = '066c187e0cf14521ae314007dda86fdf'
client_secret = '671a1551a4504e418192acc16933ad35'

try:
    # Authorization
    sp = spotipy.Spotify(
        auth_manager=SpotifyClientCredentials(
            client_id=client_id,
            client_secret=client_secret
        )
    )

    # List of playlist IDs
    playlist_ids = ['2Dpp0zCDBzkyV3lNS83UMP']

    # Extract track info
    track_info = []
    total_tracks = 0
    current_track = 0

    for playlist_id in playlist_ids:
        # Get playlist tracks
        results = sp.playlist_tracks(playlist_id)
        tracks = results['items']
        total_tracks += results['total']
        while results['next']:
            results = sp.next(results)
            tracks.extend(results['items'])

        for track in tracks:
            # Search YouTube
            query = f"{track['track']['artists'][0]['name']} - {track['track']['name']}"
            yt_results = YoutubeSearch(query, max_results=1).to_dict()  
        
            youtube_link = ""
            if yt_results:
                youtube_link = f"https://youtube.com/watch?v={yt_results[0]['id']}"

            track_info.append({
                'Artist': track['track']['artists'][0]['name'], 
                'Track': track['track']['name'],
                'Album': track['track']['album']['name'],
                'Album_type': track['track']['album']['album_type'],
                'Title': track['track']['name'],
                'Url_youtube': youtube_link,
                'Released': track['track']['album']['release_date'].split('-')[0] if track['track']['album']['release_date'] else None
            })

            current_track += 1
            progress = current_track / total_tracks * 100
            print(f'Progress: {progress:.2f}%')

    # Create DataFrame 
    df = pd.DataFrame(track_info)

    # Export to Desktop
    desktop = Path.home() / 'Desktop' / 'Scripts' / 'MediaBrake' / 'Python'
    output_file = desktop / 'spotify-playlist.xlsx'
    df.to_excel(output_file, index=False)

    print('Playlist exported as spotify-playlist.')
except Exception as e:
    print(f"An error occurred: {e}")