"use client";

import { useEffect, useRef, useState } from "react";
import { createPortal } from "react-dom";

interface IModalProps {
  title: string;
  children: React.ReactNode;
  onClose?: () => void;
}

export default function Modal({ title, children, onClose }: IModalProps) {
  const [mounted, setMounted] = useState(false);
  const portalRef = useRef<HTMLElement | null>(null);

  useEffect(() => {
    portalRef.current = document.body;
    setMounted(true);
    document.body.style.overflow = "hidden";
    return () => {
      document.body.style.overflow = "";
    };
  }, []);

  if (!mounted || !portalRef.current) return null;

  return createPortal(
    <div className="fixed inset-0 z-50 flex items-center justify-center">
      <div className="absolute inset-0 bg-black/60" onClick={onClose} />
      <div className="relative rounded-xl bg-white p-6 shadow-xl">
        <h2 className="mb-4 text-xl font-bold">{title}</h2>
        {children}
      </div>
    </div>,
    portalRef.current,
  );
}
