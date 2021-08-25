import React from "react";
import ReactMarkdown from "react-markdown";
import { Prism as SyntaxHighlighter } from "react-syntax-highlighter";
import { atomDark } from "react-syntax-highlighter/dist/cjs/styles/prism";
import Image from "next/image";
import PostHeader from "../PostHeader/PostHeader";
import classes from "./PostContent.module.css";

function PostContent({ title, image, content }) {
  const imagePath = `/images/posts/${image}`;
  return (
    <div className={classes.content}>
      <PostHeader title={title} image={imagePath} />
      <ReactMarkdown
        children={content}
        components={{
          code({ node, inline, className, children, ...props }) {
            const match = /language-(\w+)/.exec(className || "");
            return !inline && match ? (
              <SyntaxHighlighter
                children={String(children).replace(/\n$/, "")}
                style={atomDark}
                language={match[1]}
                PreTag="p"
                {...props}
              />
            ) : (
              <code className={className} {...props}>
                {children}
              </code>
            );
          },
          img: () => (
            <Image src={`${imagePath}`} alt={title} width={200} height={150} />
          ),
          p: "div",
        }}
      />
    </div>
  );
}

export default PostContent;
