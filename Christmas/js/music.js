const audio = document.getElementById('audio');
let currentTrack = 1;
const totalTracks = 5; // 전체 음악 트랙 수

function playTrack(trackNumber) {
  const musicFolder = './mp3/';
  const randomQueryParam = `?${Date.now()}`; // 무작위 쿼리 매개변수(캐시 남아있음 음원 수정해도 작동안함)
  audio.src = `${musicFolder}${trackNumber}.mp3`;
  audio.play();
}

function playNext() {
  currentTrack = (currentTrack % totalTracks) + 1;
  playTrack(currentTrack);
}

function togglePlayPause() {
  if (audio.paused) {
    audio.play();
  } else {
    audio.pause();
  }
}

// 초기에 첫 번째 트랙을 재생
playTrack(currentTrack);
