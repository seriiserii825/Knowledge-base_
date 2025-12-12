export default function initPopup() {
  const popup = document.getElementById("mainPopup");
  const closeButton = document.getElementById("closePopup");
 
  const promotionStartDateElement = document.querySelector(".popup__start") as HTMLElement;
  const promotionStartDateText = promotionStartDateElement.textContent as string;
 
  const promotionEndDateElement = document.querySelector(".popup__end") as HTMLElement;
  const promotionEndDateText = promotionEndDateElement.textContent as string;
 
  const popupTimeoutElement = document.querySelector(".popup__timeout") as HTMLElement;
  const timeoutDays = parseInt(popupTimeoutElement.textContent as string);
 
  if (!popup) return;
 
  const currentTimestamp = Date.now();
 
  function formatDateToString(timestamp?: string | number): string {
    if (timestamp) {
      return new Date(timestamp).toLocaleString("en-US", {
        year: "numeric",
        month: "2-digit",
        day: "2-digit",
        hour: "2-digit",
        minute: "2-digit",
        second: "2-digit",
      });
    }
 
    return new Date().toLocaleString("en-US", {
      year: "numeric",
      month: "2-digit",
      day: "2-digit",
      hour: "2-digit",
      minute: "2-digit",
      second: "2-digit",
    });
  }
 
  function convertDateStringToTimestamp(dateString: string): number {
    return new Date(dateString).getTime();
  }
 
  function hasPromotionStarted() {
    const promotionStartTimestamp = new Date(promotionStartDateText).getTime();
    return currentTimestamp >= promotionStartTimestamp;
  }
 
  function hasPromotionEnded() {
    const promotionEndTimestamp = new Date(promotionEndDateText).getTime();
    return currentTimestamp > promotionEndTimestamp;
  }
 
  function canShowPopupAgain() {
      const nextPopupShowDateString = localStorage.getItem("nextPopupShowDate");
 
    if (!nextPopupShowDateString) {
      return true;
    }
 
    const nextPopupShowTimestamp = convertDateStringToTimestamp(nextPopupShowDateString);
    return currentTimestamp >= nextPopupShowTimestamp;
  }
 
  const isPromotionActive = hasPromotionStarted() && !hasPromotionEnded();
  const canShowPopup = canShowPopupAgain();
 
  if (isPromotionActive && canShowPopup) {
    setTimeout(() => {
      popup.classList.add("active");
      document.body.style.overflow = "hidden";
    }, 500);
  }
 
  const handleClosePopup = () => {
    popup.classList.remove("active");
    document.body.style.overflow = "";
 
    const nextDay = new Date();
    nextDay.setDate(nextDay.getDate() + timeoutDays);
    nextDay.setHours(0, 0, 0, 0);
 
    const nextShowDate = formatDateToString(nextDay.getTime());
    localStorage.setItem("nextPopupShowDate", nextShowDate);
  };
 
  if (closeButton) {
    closeButton.addEventListener("click", handleClosePopup);
  }
 
  popup.addEventListener("click", (e) => {
    if (e.target === popup) {
      handleClosePopup();
    }
  });
 
  document.addEventListener("keydown", (e) => {
    if (e.key === "Escape" && popup.classList.contains("active")) {
      handleClosePopup();
    }
  });
}
